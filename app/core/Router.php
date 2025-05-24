<?php

namespace App\core;

use App\traits\FromStatic;
use App\traits\RouteHelper;
use App\traits\RouteParameter;
use App\traits\RouteMethodHelper;
use App\interface\MethodsInterface;

class Router implements MethodsInterface
{
    use FromStatic, RouteHelper, RouteMethodHelper, RouteParameter;

    private $routes = [];
    private $groupAttributes = [];
    private $groupCallback = null;

    

}