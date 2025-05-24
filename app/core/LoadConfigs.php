<?php

namespace App\core;

use App\exceptions\LoadFileException;
use App\interface\LoadConfig;

class LoadConfigs implements LoadConfig
{
    public static function loadConfig($filePath)
    {
        // dd($filePath, "file path");
        // Load the configuration file
        if (file_exists($filePath)) 
        {
            // dd($filePath, "file exists");
            return require $filePath;

        } else 
        {
            // throw new \Exception("Configuration file not found: " . $filePath);
            throw new LoadFileException();
        }
    }
    
}
