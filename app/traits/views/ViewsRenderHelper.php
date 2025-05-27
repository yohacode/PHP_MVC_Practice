<?php declare(strict_types=1);
/**
 * * View Render Helper Trait
 * * This trait provides methods for rendering views, layouts, partials, components, blocks, and templates.
 * * It also includes methods for applying decorators to the rendered content.
 */

namespace App\traits\views;
if (!defined('BASE_PATH')) {
    // If BASE_PATH is not defined, define it relative to this file
    // This assumes the file is located in app/traits/views/ViewsRenderHelper.php
    // Adjust the path as necessary based on your directory structure
    define('BASE_PATH', dirname(__DIR__, 2)); // Define BASE_PATH relative to this file
}


trait ViewsRenderHelper
{
    // Removed use ViewsDecorator to avoid circular dependency

    /**
     * Data available to decorators.
     * @var array|null
     */
    protected ?array $decoratorData = null;

    public function render(string $view, array $data = []): string
    {
        return $this->applyDecorators(
            $this->renderView($view, $data)
        );
    }

    protected function renderView(string $view, array $data): string
    {
        // store data into an array with key value pair 
        $data = is_array($data) ? $data : ['data' => $data];

        
        $viewPath = $this->getViewPath($view);
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: " . $viewPath);
        }

        ob_start();
        // If $data is a multidimensional array with a single key, extract that key as variable
        if (is_array($data))
        {
            // Check if the array has a single key
            $varName = key($data);
            $$varName = $data[$varName];
            extract([$varName => $$varName]);
        }
        // dd($v); // Debugging output, remove in production
        include $viewPath;
        return ob_get_clean();
    }

    protected function applyDecorators(string $content): string
    {
        // Double curly: {{...}} => htmlentities(...)
        $content = preg_replace_callback('/{{\s*(.*?)\s*}}/', function ($matches) 
        {
            // dd($matches);
            return htmlentities($this->evaluate($matches[1]));
        }, $content);

        // Single curly: {...} => evaluate and return raw
        $content = preg_replace_callback('/{\s*(.*?)\s*}/', function ($matches) 
        {
            // dd($matches);
            return $this->evaluate($matches[1]);
        }, $content);

        // Underscore: _(text) => translate(text)
        $content = preg_replace_callback('/_\((.*?)\)/', function ($matches) {
            return $this->translate(trim($matches[1], "'\""));
        }, $content);

        // Pipe: ||expression|| => strtoupper(...) as example
        $content = preg_replace_callback('/\|\|\s*(.*?)\s*\|\|/', function ($matches) {
            return strtoupper($this->evaluate($matches[1]));
        }, $content);

        // dd($content);
        return $content;
    }

    protected function evaluate(string $expression)
    {
        extract($this->decoratorData ?? []);
        return eval('return ' . $expression . ';');
    }

    protected function translate(string $text): string
    {
        // Simulate translation - you can hook into a real i18n system here
        return "[[$text]]";
    }

    public function layout(string $name, array $argc): string
    {
        return $this->applyDecorators($this->renderGeneric($this->getLayoutPath($name), $argc));
    }

    public function partial(string $name, array $argc): string
    {
        return $this->applyDecorators($this->renderGeneric($this->getPartialPath($name), $argc));
    }

    public function component(string $name, array $argc): string
    {
        return $this->applyDecorators($this->renderGeneric($this->getComponentPath($name), $argc));
    }

    public function block(string $name, array $argc): string
    {
        return $this->applyDecorators($this->renderGeneric($this->getBlockPath($name), $argc));
    }

    public function template(string $name, array $argc): string
    {
        return $this->applyDecorators($this->renderGeneric($this->getTemplatePath($name), $argc));
    }

    protected function renderGeneric(string $path, array $argc): string
    {
        if (!file_exists($path)) {
            throw new \Exception("File not found: " . $path);
        }
        ob_start();
        $this->decoratorData = $argc;
        extract($argc);
        include $path;
        return ob_get_clean();
    }
}