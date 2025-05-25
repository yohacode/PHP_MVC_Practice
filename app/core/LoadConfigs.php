<?php

namespace App\core;

use App\exceptions\LoadFileException;
use App\interface\LoadConfig;

class LoadConfigs implements LoadConfig
{
    /**
     * Load a configuration file from the specified path.
     * @param string $filePath The path to the configuration file.
     * @return array<mixed> The configuration settings loaded from the file.
     */
    public static function loadConfig(string $filePath): array
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
