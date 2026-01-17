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

        // Cree l-folder d-l-cache ila malkahch
        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }
    }

    public function render(string $view, array $data = []): string
    {
        $viewClean = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $view);
        $viewPath = rtrim($this->viewsPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $viewClean . '.med.php';
        $cacheFile = $this->cachePath . DIRECTORY_SEPARATOR . md5($view) . '.php';

        // dd($viewPath);

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }

        if (!$this->isCacheValid($viewPath, $cacheFile)) {
            $content = file_get_contents($viewPath);
            $compiled = $this->compile($content);
            file_put_contents($cacheFile, $compiled);
        }

        extract($data);
        ob_start();
        include $cacheFile; // Use l-path d-l-fichier l-m7soub
        $content = ob_get_clean();

        if ($this->layout) {
            $layoutView = $this->layout;
            $this->layout = null;
            return $this->render($layoutView, $data);
        }

        return $content;
    }

    public function compile(string $content): string
    {
        // 1. Inheritance
        $content = preg_replace('/@extends\(\'(.*?)\'\)/', '<?php $this->layout = "$1"; ?>', $content);
        $content = preg_replace('/@yield\(\'(.*?)\'\)/', '<?php echo $this->sections["$1"] ?? ""; ?>', $content);
        $content = preg_replace('/@section\(\'(.*?)\'\)/', '<?php $this->currentSection = "$1"; ob_start(); ?>', $content);
        $content = preg_replace('/@endsection/', '<?php $this->sections[$this->currentSection] = ob_get_clean(); ?>', $content);
        $content = preg_replace('/@include\(\'(.*?)\'\)/', '<?php echo $this->render("$1", $data); ?>', $content);
        // 2. Method Spoofing
        $content = preg_replace('/@method\(\'(.*?)\'\)/', '<input type="hidden" name="_method" value="$1">', $content);

        // 3. Variables
        $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo htmlspecialchars((string)$1); ?>', $content);

        // 4. Control Structures
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        return $content;
    }

    private function isCacheValid($view, $cache): bool
    {
        return file_exists($cache) && filemtime($view) <= filemtime($cache);
    }
}
