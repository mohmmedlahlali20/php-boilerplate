<?php

namespace App\Core\View;

use App\Core\Interfaces\TemplateEngineInterface;

class BladeEngine implements TemplateEngineInterface
{
    private $viewsPath;
    private $cachePath;
    private $sections = [];
    private $currentSection;
    private $layout;

    public function __construct($viewsPath, $cachePath)
    {
        $this->viewsPath = $viewsPath;
        $this->cachePath = $cachePath;
    }

    public function render(string $view, array $data = []): string
    {
        $viewPath = $this->viewsPath . '/' . $view . '.med.php';
        $cachePath = $this->cachePath . '/' . md5($view) . '.php';

        // Check if view exists
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }

        // Compile if cache is invalid
        if (!$this->isCacheValid($viewPath, $cachePath)) {
            $content = file_get_contents($viewPath);
            $compiled = $this->compile($content);
            file_put_contents($cachePath, $compiled);
        }

        extract($data);
        ob_start();
        include $cachePath;
        $content = ob_get_clean();

        // Handle Layout Inheritance (@extends)
        if ($this->layout) {
            $layoutView = $this->layout;
            $this->layout = null; // Reset for next use
            return $this->render($layoutView, $data);
        }

        return $content;
    }

    public function compile(string $content): string
    {
        // 1. Inheritance Directives
        $content = preg_replace('/@extends\(\'(.*?)\'\)/', '<?php $this->layout = "$1"; ?>', $content);
        $content = preg_replace('/@yield\(\'(.*?)\'\)/', '<?php echo $this->sections["$1"] ?? ""; ?>', $content);
        $content = preg_replace('/@section\(\'(.*?)\'\)/', '<?php $this->currentSection = "$1"; ob_start(); ?>', $content);
        $content = preg_replace('/@endsection/', '<?php $this->sections[$this->currentSection] = ob_get_clean(); ?>', $content);

        // 2. Method Spoofing (PUT/DELETE)
        $content = preg_replace('/@method\(\'(.*?)\'\)/', '<input type="hidden" name="_method" value="$1">', $content);
        
        // 3. Variables {{ $var }}
        $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo htmlspecialchars((string)$1); ?>', $content);
        
        // 4. IF Statements
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        
        // 5. Foreach Loops
        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        return $content;
    }

    private function isCacheValid($view, $cache): bool
    {
        // Always re-compile in development if you prefer, 
        // but this logic checks if original file was modified.
        return file_exists($cache) && filemtime($view) <= filemtime($cache);
    }
}