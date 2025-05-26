<?php

namespace App\controller;

use App\core\View;

class HomeController
{
    // debugging   info
    public function __construct()
    {
        // You can initialize any dependencies or services here
        // For example, if you have a database connection, you can set it up here
        // var_dump($this); // Uncomment this line for debugging if needed
    }
    
    public function index(): void
    {
        // echo 'Hello, World!';

        $view = new View();
        echo $view->layout('app', [
            'title' => 'Home Page',
            'content' => $view->view('index', ['title' => 'Home Page'])
        ]);
        // echo $view->view('index', ['title' => 'Home Page']);
    }

    public function show(): void
    {
        // This method can be used to show a specific page or resource
        echo 'This is the show method of HomeController.';
    }

}