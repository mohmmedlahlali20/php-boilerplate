<?php

namespace App\Core\View;

use App\Core\Interfaces\TemplateEngineInterface;
use Exception;

/**
 * Class BladeEngine
 * * A custom template engine that compiles .med.php files into native PHP.
 * Supports template inheritance, sections, control structures, and custom directives.
 */
class BladeEngine implements TemplateEngineInterface
{
    /** @var string Path to raw view files */
    private string $viewsPath;

    /** @var string Path to compiled PHP files */
    private string $cachePath;

    /** @var array Stores content for different layout sections */
    private array $sections = [];

    /** @var string|null Tracks the currently active section being captured */
    private ?string $currentSection = null;

    /** @var string|null Stores the parent layout view name */
    private ?string $layout = null;

    /**
     * BladeEngine constructor.
     * @param string $viewsPath
     * @param string $cachePath
     */
    public function __construct(string $viewsPath, string $cachePath)
    {
        $this->viewsPath = rtrim($viewsPath, DIRECTORY_SEPARATOR);
        $this->cachePath = rtrim($cachePath, DIRECTORY_SEPARATOR);

        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }
    }

    /**
     * Renders a view by compiling it (if needed) and extracting data.
     * * @param string $view
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function render(string $view, array $data = []): string
    {
        $viewClean = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $view);
        $viewPath = $this->viewsPath . DIRECTORY_SEPARATOR . $viewClean . '.med.php';
        $cacheFile = $this->cachePath . DIRECTORY_SEPARATOR . md5($view) . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewPath}");
        }

        // Recompile only if the view file was modified or cache doesn't exist
        if (!$this->isCacheValid($viewPath, $cacheFile)) {
            $content = file_get_contents($viewPath);
            $compiled = $this->compile($content);
            file_put_contents($cacheFile, $compiled);
        }

        // Extract variables to current scope for use in the included file
        extract($data);
        ob_start();
        include $cacheFile;
        $content = ob_get_clean();

        // Handle Template Inheritance (@extends)
        if ($this->layout) {
            $layoutView = $this->layout;
            $this->layout = null; // Reset for next cycle
            return $this->render($layoutView, $data);
        }

        return $content;
    }

    /**
     * Compiles custom directives into native PHP code.
     * * @param string $content
     * @return string
     */
    public function compile(string $content): string
    {
        // 1. Template Inheritance & Inclusion
        $content = preg_replace('/@extends\(\'(.*?)\'\)/', '<?php $this->layout = "$1"; ?>', $content);
        $content = preg_replace('/@yield\(\'(.*?)\'\)/', '<?php echo $this->sections["$1"] ?? ""; ?>', $content);
        $content = preg_replace('/@section\(\'(.*?)\'\)/', '<?php $this->currentSection = "$1"; ob_start(); ?>', $content);
        $content = preg_replace('/@endsection/', '<?php $this->sections[$this->currentSection] = ob_get_clean(); ?>', $content);

        // Fixed: Ensure $data is passed to included views
        $content = preg_replace('/@include\(\'(.*?)\'\)/', '<?php echo $this->render("$1", get_defined_vars()); ?>', $content);

        // 2. Control Structures
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        // @flash('success') ... @endflash
        $content = preg_replace('/@flash\(\'(.*?)\'\)/i', '<?php if($msg = flash("$1")): ?>', $content);
        $content = preg_replace('/@endflash/i', '<?php endif; ?>', $content);

        // 3. Variable Echoing (XSS Protection via htmlspecialchars)
        $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo htmlspecialchars((string)($1), ENT_QUOTES, "UTF-8"); ?>', $content);

        // 4. Custom Directives (@CSRF, @PUT, @DELETE)
        $content = $this->compileCustomDirectives($content);

        return $content;
    }

    /**
     * Processes specialized framework directives.
     * * @param string $content
     * @return string
     */
    protected function compileCustomDirectives(string $content): string
    {
        // @CSRF() -> Hidden input with session token
        $content = preg_replace_callback('/@CSRF\(\)/i', function () {
            $token = $_SESSION['csrf_token'] ?? '';
            return '<input type="hidden" name="csrf_token" value="' . $token . '">';
        }, $content);

        // Method Spoofing
        $content = preg_replace('/@PUT\(\)/i', '<input type="hidden" name="_method" value="PUT">', $content);
        $content = preg_replace('/@DELETE\(\)/i', '<input type="hidden" name="_method" value="DELETE">', $content);
        $content = preg_replace('/@method\(\'(.*?)\'\)/', '<input type="hidden" name="_method" value="$1">', $content);

        return $content;
    }

    /**
     * Checks if the cached file is still fresh.
     * * @param string $view
     * @param string $cache
     * @return bool
     */
    private function isCacheValid(string $view, string $cache): bool
    {
        return file_exists($cache) && filemtime($view) <= filemtime($cache);
    }
}
