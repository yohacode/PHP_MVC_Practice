<?php

namespace App\core;

// if (!defined('BASE_PATH')) {
//     // If BASE_PATH is not defined, define it relative to this file
//     // This assumes the file is located in app/core/View.php
//     // Adjust the path as necessary based on your directory structure
//     define('BASE_PATH', dirname(__DIR__, 2)); // Define BASE_PATH relative to this file
// }
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
        $baseViewPath = dirname(__DIR__, 2). '/views'; 
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
    public function view($name, $argc): void
    {
        $view = $this->render($name, $argc); 
        try {
            echo $this->applyDecorators($view);
        } catch (\Exception $e) {
            throw new \App\exceptions\views\ViewsGetHelperExceptions("Error rendering view: " . $e->getMessage(), 500, $e);
        }

        // return $view;
    }





}