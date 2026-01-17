<?php

namespace App\Core\View;

use App\Core\Interfaces\TemplateEngineInterface;

class BladeEngine implements TemplateEngineInterface
{
    private $viewsPath;
    private $cachePath;

    public function __construct($viewsPath, $cachePath)
    {
        $this->viewsPath = $viewsPath;
        $this->cachePath = $cachePath;
    }

    public function render(string $view, array $data = []): string
    {
        $viewPath = $this->viewsPath . '/' . $view . '.blade.php';
        $cachePath = $this->cachePath . '/' . md5($view) . '.php';

        if (!$this->isCacheValid($viewPath, $cachePath)) {
            $content = file_get_contents($viewPath);
            $compiled = $this->compile($content);
            file_put_contents($cachePath, $compiled);
        }

        extract($data);
        ob_start();
        include $cachePath;
        return ob_get_clean();
    }

    public function compile(string $content): string
    {
        // Method Spoofing (PUT/DELETE)
        $content = preg_replace('/@method\(\'(.*?)\'\)/', '<input type="hidden" name="_method" value="$1">', $content);
        
        // Variables {{ $var }}
        $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo htmlspecialchars($1); ?>', $content);
        
        // IF Statements
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        
        // Foreach Loops
        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        return $content;
    }

    private function isCacheValid($view, $cache): bool
    {
        return file_exists($cache) && filemtime($view) <= filemtime($cache);
    }
}