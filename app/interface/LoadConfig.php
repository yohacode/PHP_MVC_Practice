<?php

namespace App\interface;

interface LoadConfig
{
    public static function loadConfig(string $filePath): array;
}