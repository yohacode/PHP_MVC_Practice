<?php

// Routes for the web application { Vanilla PHP project }
use App\core\Router;

Router::get('/', [App\controller\HomeController::class, 'index']); // Home page route
Router::get('/home', 'App\controller\HomeController@show'); // Home page route with string callback
// Router::get('/about', view('index')); 


