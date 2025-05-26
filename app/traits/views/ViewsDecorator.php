<?php declare(strict_types=1);

// This file is part of the App\traits\views namespace
// It provides traits for view rendering and retrieval in the application.
/**
 * * View Decorator Trait
 * * This trait provides methods for rendering views, layouts, partials, components, blocks, and templates.
 * * It also includes methods for retrieving paths for various resources like config, language, log, cache, and views.
 */

namespace App\traits\views;

use App\traits\views\ViewsRenderHelper;
use App\traits\views\ViewsGetHelper;


trait ViewsDecorator
{
    use ViewsGetHelper;
    use ViewsRenderHelper;

    protected string $viewPath;
    protected string $layoutPath;
    protected string $partialPath;
    protected string $componentPath;
    protected string $blockPath;
    protected string $templatePath;

    public function __construct()
    {
        $baseViewPath = BASE_PATH . '/views';
        $this->viewPath = $baseViewPath . '/';
        $this->layoutPath = $baseViewPath . '/layouts/';
        $this->partialPath = $baseViewPath . '/partials/';
        $this->componentPath = $baseViewPath . '/components/';
        $this->blockPath = $baseViewPath . '/blocks/';
        $this->templatePath = $baseViewPath . '/templates/';
    }

    public function view(string $name, array $argc): string
    {
        return $this->render($name, $argc);
    }

    public function layout(string $name, array $argc): string
    {
        return $this->renderLayout($name, $argc);
    }

    public function partial(string $name, array $argc): string
    {
        return $this->renderPartial($name, $argc);
    }

    public function component(string $name, array $argc): string
    {
        return $this->renderComponent($name, $argc);
    }

    public function block(string $name, array $argc): string
    {
        return $this->renderBlock($name, $argc);
    }

    public function template(string $name, array $argc): string
    {
        return $this->renderTemplate($name, $argc);
    }

    public function renderTemplate(string $name, array $argc): string
    {
        $templatePath = $this->getTemplatePath($name);
        if (!file_exists($templatePath)) {
            throw new \Exception("Template file not found: " . $templatePath);
        }

        ob_start();
        extract($argc);
        include $templatePath;
        return ob_get_clean();
    }

    public function render(string $name, array $argc): string
    {
        $viewPath = $this->getViewPath($name);
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: " . $viewPath);
        }

        ob_start();
        extract($argc);
        include $viewPath;
        return ob_get_clean();
    }

    public function renderLayout(string $name, array $argc): string
    {
        $layoutPath = $this->getLayoutPath($name);
        if (!file_exists($layoutPath)) {
            throw new \Exception("Layout file not found: " . $layoutPath);
        }

        ob_start();
        extract($argc);
        include $layoutPath;
        return ob_get_clean();
    }

    public function renderPartial(string $name, array $argc): string
    {
        $partialPath = $this->getPartialPath($name);
        if (!file_exists($partialPath)) {
            throw new \Exception("Partial file not found: " . $partialPath);
        }

        ob_start();
        extract($argc);
        include $partialPath;
        return ob_get_clean();
    }

    public function renderComponent(string $name, array $argc): string
    {
        $componentPath = $this->getComponentPath($name);
        if (!file_exists($componentPath)) {
            throw new \Exception("Component file not found: " . $componentPath);
        }

        ob_start();
        extract($argc);
        include $componentPath;
        return ob_get_clean();
    }

    public function renderBlock(string $name, array $argc): string
    {
        $blockPath = $this->getBlockPath($name);
        if (!file_exists($blockPath)) {
            throw new \Exception("Block file not found: " . $blockPath);
        }

        ob_start();
        extract($argc);
        include $blockPath;
        return ob_get_clean();
    }

    public function getViewPath(string $name): string
    {
        return $this->viewPath . $name . '.php';
    }

    public function getLayoutPath(string $name): string
    {
        return $this->layoutPath . $name . '.php';
    }

    public function getPartialPath(string $name): string
    {
        return $this->partialPath . $name . '.php';
    }

    public function getComponentPath(string $name): string
    {
        return $this->componentPath . $name . '.php';
    }

    public function getBlockPath(string $name): string
    {
        return $this->blockPath . $name . '.php';
    }

    public function getTemplatePath(string $name): string
    {
        return $this->templatePath . $name . '.php';
    }

    public function getBaseViewPath(): string
    {
        return $this->viewPath;
    }

    public function getBaseLayoutPath(): string
    {
        return $this->layoutPath;
    }

    public function getBasePartialPath(): string
    {
        return $this->partialPath;
    }

    public function getBaseComponentPath(): string
    {
        return $this->componentPath;
    }

    public function getBaseBlockPath(): string
    {
        return $this->blockPath;
    }

    public function getBaseTemplatePath(): string
    {
        return $this->templatePath;
    }
}
