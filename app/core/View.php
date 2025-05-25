<?php

namespace App\core;

define('BASE_PATH', __DIR__ . '/../..'); // Define BASE_PATH relative to this file
/**
 * View class for rendering views in the application.
 *
 * This class provides methods to render views, layouts, partials, components, blocks, and templates.
 * It uses traits for helper methods related to view rendering and retrieval.
 *
 * @package App\core
 */

class View implements \App\interface\ViewInterface
{
    use \App\traits\views\ViewsGetHelper;
    use \App\traits\views\ViewsRenderHelper;

    protected string $viewPath;
    protected string $layoutPath;
    protected string $partialPath;
    protected string $componentPath;
    protected string $blockPath;
    protected string $templatePath;

    public function __construct()
    {
        $baseViewPath = BASE_PATH. '/views'; // Assuming BASE_PATH is defined somewhere in your application
        $this->viewPath = $baseViewPath.'/';
        $this->layoutPath = $baseViewPath . '/layouts/';
        $this->partialPath = $baseViewPath . '/partials/';
        $this->componentPath = $baseViewPath . '/components/';
        $this->blockPath = $baseViewPath . '/blocks/';
        $this->templatePath = $baseViewPath . '/templates/';
    }

    /**
     * Renders a view file with the given name and arguments.
     *
     * @param string $name The name of the view file to render.
     * @param array<mixed> $argc The arguments to pass to the view
     * @return string The rendered view content.
     */
    public function view($name, $argc): string
    {
        return $this->render($name, $argc); // Default view, can be changed as needed
    }





}