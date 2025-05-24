<?php

namespace App\controller;

class HomeController
{
    // debugging   info
    public function __construct()
    {
        // You can initialize any dependencies or services here
        // For example, if you have a database connection, you can set it up here
        // var_dump($this); // Uncomment this line for debugging if needed
    }
    
    public function index()
    {
        echo 'Hello, World!';
    }

    public function show()
    {
        // This method can be used to show a specific page or resource
        echo 'This is the show method of HomeController.';
    }

}