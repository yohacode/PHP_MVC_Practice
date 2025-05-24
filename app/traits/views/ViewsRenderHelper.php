<?php

namespace App\traits\views;

trait ViewsRenderHelper
{
    
    public function render(string $view, array $data = []): string
    {
        // Implementation of rendering logic
        // dd($view);
        return $this->renderView($view, $data);
    }

    protected function renderView(string $view, array $data): string
    {
        $viewPath = $this->getViewPath($view);
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: " . $viewPath);
        }

        ob_start();
        extract($data);
        include $viewPath;
        return ob_get_clean();
    }
}