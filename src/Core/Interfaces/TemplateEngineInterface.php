<?php

namespace App\Core\Interfaces;

/**
 * Interface TemplateEngineInterface
 * Contract for template engines (e.g., Blade, Twig) to handle view rendering and compilation.
 */
interface TemplateEngineInterface
{
    /**
     * Renders a view file with the provided data.
     * * @param string $view The name/path of the view file (e.g., 'auth.login').
     * @param array $data The associative array of data to pass to the view.
     * @return string The fully rendered HTML content.
     */
    public function render(string $view, array $data = []): string;

    /**
     * Compiles the raw template content into plain PHP code.
     * * @param string $content The raw template strings (e.g., with @directives).
     * @return string The compiled PHP code ready for execution.
     */
    public function compile(string $content): string;
}