<?php

// Routes for the web application { Vanilla PHP project }
use App\core\Router;

Router::get('/', function () {
    // echo 'Welcome to the home page!';
    function hello() {
        return "Hi! From variable function.";
    }
    $function = 'hello';
    echo $function(); // Hi!

});

Router::get('/about', function () {
    // echo 'This is the about page.';
    $closure = function() {
        return "Hi! From closure function.";
    };
    echo $closure(); // Hi!
});


// Route with parameters
Router::get('/user/{id}', function ($id) {
    // echo "User ID: $id";
    echo "User ID: $id";
});

Router::get('/user/{id}/profile', function ($id) {
    // echo "User ID: $id";
    echo "User ID: $id";
});


