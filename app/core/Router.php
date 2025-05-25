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

    /** @var array<string, array<mixed>> */
    protected array $routes = [];
    /** @var array<string, mixed> */
    protected array $groupAttributes = [];
    protected mixed $groupCallback = null;


}
