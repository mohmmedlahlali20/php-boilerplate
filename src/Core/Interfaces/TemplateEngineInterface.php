<?php

namespace App\Core\Interfaces;

interface TemplateEngineInterface
{
    public function render(string $view, array $data = []): string;
    public function compile(string $content): string;
}
