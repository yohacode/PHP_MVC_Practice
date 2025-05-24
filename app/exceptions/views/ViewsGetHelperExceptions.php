<?php

namespace App\exceptions\views;
use \Exception;

class ViewsGetHelperExceptions extends Exception
{
    public static function configFileNotFound(string $config): self
    {
        return new self("Configuration file not found: " . $config);
    }

    public static function languageFileNotFound(string $language): self
    {
        return new self("Language file not found: " . $language);
    }

    public static function logFileNotFound(string $log): self
    {
        return new self("Log file not found: " . $log);
    }

    public static function cacheFileNotFound(string $cache): self
    {
        return new self("Cache file not found: " . $cache);
    }

    public static function viewFileNotFound(string $view): self
    {
        return new self("View file not found: " . $view);
    }
}
