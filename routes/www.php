<?php

// Routes for the web application { Vanilla PHP project }

// Include the router class


use App\core\Router;

Router::get('/', function () {
    echo 'Welcome to the home page!';
});

Router::get('/about', function () {
    echo 'This is the about page.';
});

