<?php

// Routes for the web application { Vanilla PHP project }
// use ;
use App\core\Router;

Router::get('/', [App\controller\HomeController::class, 'index']); // Home page route
Router::get('/home', 'App\controller\HomeController@index'); // Home page route with string callback

Router::get('/about', function (){
    echo "hi!. this John.";
}); // About page route


