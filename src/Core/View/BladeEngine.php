<?php

namespace App\Core\View;

use App\Core\Interfaces\TemplateEngineInterface;
use Exception;

/**
 * Class BladeEngine
 * A custom template engine that compiles .med.php files into native PHP.
 */
class BladeEngine implements TemplateEngineInterface
{
    private string $viewsPath;
    private string $cachePath;
    private array $sections = [];
    private ?string $currentSection = null;
    private ?string $layout = null;

    public function __construct(string $viewsPath, string $cachePath)
    {
        $this->viewsPath = rtrim($viewsPath, DIRECTORY_SEPARATOR);
        $this->cachePath = rtrim($cachePath, DIRECTORY_SEPARATOR);

        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }
    }

    public function render(string $view, array $data = []): string
    {
        $viewClean = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $view);
        $viewPath = $this->viewsPath . DIRECTORY_SEPARATOR . $viewClean . '.demon.php';
        $cacheFile = $this->cachePath . DIRECTORY_SEPARATOR . md5($view) . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewPath}");
        }

        if (!$this->isCacheValid($viewPath, $cacheFile)) {
            $content = file_get_contents($viewPath);
            file_put_contents($cacheFile, $this->compile($content));
        }

        extract($data);

        // 1. Capture the view execution
        ob_start();
        include $cacheFile;
        $childOutput = ob_get_clean();

        // 2. If @extends was used, $this->layout is now set
        if ($this->layout !== null) {
            $layoutToRender = $this->layout;
            $this->layout = null; // Reset

            // IMPORTANT: We return ONLY the layout. 
            // We do NOT return $childOutput because it only contains 
            // HTML that was OUTSIDE of @section blocks.
            return $this->render($layoutToRender, $data);
        }

        // 3. If NO layout, return the captured output
        return $childOutput;
    }

    public function compile(string $content): string
    {
        // 1. Template Inheritance
        // Use single quotes for the string keys to avoid variable interpolation issues
        $content = preg_replace('/@extends\(([\'"])(.*?)\1\)/', '<?php $this->layout = \'$2\'; ?>', $content);
        $content = preg_replace('/@yield\(([\'"])(.*?)\1\)/', '<?php echo $this->sections[\'$2\'] ?? ""; ?>', $content);
        $content = preg_replace('/@section\(([\'"])(.*?)\1\)/', '<?php $this->currentSection = \'$2\'; ob_start(); ?>', $content);
        $content = preg_replace('/@endsection/', '<?php $this->sections[$this->currentSection] = ob_get_clean(); ?>', $content);


        // 2. Safe Inclusion
        $content = preg_replace_callback(
            "/@include\(\s*['\"](.+?)['\"]\s*\)/",
            function ($matches) {
                $view = $matches[1];

                return <<<PHP
                    <?php
                        \$view = '{$view}';
                        \$viewPath = \$this->viewsPath . DIRECTORY_SEPARATOR .
                            strtr(\$view, ['/' => DIRECTORY_SEPARATOR, '\\\\' => DIRECTORY_SEPARATOR]) .
                            '.demon.php';

                        if (file_exists(\$viewPath)) {
                            \$cacheFile = \$this->cachePath . DIRECTORY_SEPARATOR . md5(\$viewPath) . '.php';

                            if (!\$this->isCacheValid(\$viewPath, \$cacheFile)) {
                                file_put_contents(
                                    \$cacheFile,
                                    \$this->compile(file_get_contents(\$viewPath))
                                );
                            }

                            extract(get_defined_vars(), EXTR_SKIP);
                            include \$cacheFile;
                        }
                    ?>
                    PHP;
            },
            $content
        );



        // 3. Control Structures
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        // 4. Variables & XSS Protection
        $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo htmlspecialchars((string)($1), ENT_QUOTES, "UTF-8"); ?>', $content);

        // 5. Custom Directives
        $content = $this->compileCustomDirectives($content);

        return $content;
    }

    protected function compileCustomDirectives(string $content): string
    {
        $content = preg_replace_callback('/@CSRF\(\)/i', function () {
            $token = $_SESSION['csrf_token'] ?? '';
            return '<input type="hidden" name="csrf_token" value="' . $token . '">';
        }, $content);

        $content = preg_replace('/@PUT\(\)/i', '<input type="hidden" name="_method" value="PUT">', $content);
        $content = preg_replace('/@DELETE\(\)/i', '<input type="hidden" name="_method" value="DELETE">', $content);

        return $content;
    }

    private function isCacheValid(string $view, string $cache): bool
    {
        return file_exists($cache) && filemtime($view) <= filemtime($cache);
    }
}
