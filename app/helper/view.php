<?php

namespace App\traits;

if (!function_exists('view'))
{
    /**
     * Helper function to create a new View instance.
     *
     * @return string
     */
    function view()
    {
        $v = new \App\core\View();
        return $v->view('index', []);
    }

}

// dd(view());