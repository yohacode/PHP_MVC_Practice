<?php

namespace App\traits\app;

// use App\container\AppContainer;

trait ApplyContainer 
{
    /**
     * @var array<string, mixed>
     */
    protected $app = [];
    /**
     * @var array<string, mixed>
     */
    protected $appConfig = [];
    /**
     * @var array<string, mixed>
     */
    protected $appConfigPath = [];
    /**
     * @var array<string, mixed>
     */
    protected $appConfigFile = [];



    /**
     * @var array<string, mixed>
     */
    protected $appConfigFilePath = [];
    /**
     * @var array<string, mixed>
     */
    protected $appConfigFileName = [];
    /**
     * @var array<string, mixed>
     */
    protected $appConfigFileNamePath = [];
    /**
     * @var array<string, mixed>
     */
    protected $appConfigFileNamePathFile = [];





    // Methods to get the app config and to instantiate the app container
    /**
     * @return array<string, mixed>
     */
    public function getAppConfig(): array
    {
        return $this->appConfig;
    }

    /**
     * @param array<string, mixed> $appConfig
     */
    public function setAppConfig(array $appConfig): void
    {
        $this->appConfig = $appConfig;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAppConfigPath(): array
    {
        return $this->appConfigPath;
    }

    /**
     * @param array<string, mixed> $appConfigPath
     */
    public function setAppConfigPath(array $appConfigPath): void
    {
        $this->appConfigPath = $appConfigPath;
    }

    // Methods to instantiate from app container
    /**
     * @return array<string, mixed>
     */
    public function getApp(): array
    {
        return $this->app;
    }
    /**
     * @param array<string, mixed> $app
     */
    public function setApp(array $app): void
    {
        $this->app = $app;
    }
    /**
     * @return array<string, mixed>
     */
    public function getAppConfigFile(): array
    {
        return $this->appConfigFile;
    }
    /**
     * @param array<string, mixed> $appConfigFile
     */
    public function setAppConfigFile(array $appConfigFile): void
    {
        $this->appConfigFile = $appConfigFile;
    }
}