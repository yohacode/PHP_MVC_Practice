<?php declare(strict_types=1);

/**
 * This file is part of the MVC project.
 * It is subject to the license terms that are bundled with this package in the file LICENSE.
 * @link htpps://github.com/yohacode/MVC_Practice
 * @author Yohannes Zerihun 
 * @copyright 2023 Yohannes Zerihun
 * @license MIT
 * @version 1.0.0
 */

use App\core\Application;

define('Microtime', microtime(true));

include __DIR__ . '/../vendor/autoload.php';

Application::run();
