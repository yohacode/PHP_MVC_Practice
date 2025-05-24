<?php

// Routes for the web application { Vanilla PHP project }

// Include the router class


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
    // tring closure
    $closure = function() {
        return "Hi! From closure function.";
    };
    echo $closure(); // Hi!
});



