<?php

namespace App\core;

class View implements \App\interface\ViewInterface
{
    use \App\traits\views\ViewsGetHelper;
    use \App\traits\views\ViewsRenderHelper;

    protected $viewPath;
    protected $layoutPath;
    protected $partialPath;
    protected $componentPath;
    protected $blockPath;
    protected $templatePath;

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

    public function view($name, $argc): string
    {
        return $this->render($name, $argc); // Default view, can be changed as needed
    }





}