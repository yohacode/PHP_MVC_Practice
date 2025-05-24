<?php

namespace App\traits\app;

use App\container\AppContainer;

class ApplyContainer extends AppContainer
{
    /**
     * @var array
     */
    protected $app = [];
    /**
     * @var array
     */
    protected $appConfig = [];
    /**
     * @var array
     */
    protected $appConfigPath = [];
    /**
     * @var array
     */
    protected $appConfigFile = [];



    /**
     * @var array
     */
    protected $appConfigFilePath = [];
    /**
     * @var array
     */
    protected $appConfigFileName = [];
    /**
     * @var array
     */
    protected $appConfigFileNamePath = [];
    /**
     * @var array
     */
    protected $appConfigFileNamePathFile = [];





    // Methods to get the app config and to instantiate the app container
    /**
     * @return array
     */
    public function getAppConfig()
    {
        return $this->appConfig;
    }

    /**
     * @param array $appConfig
     */
    public function setAppConfig($appConfig)
    {
        $this->appConfig = $appConfig;
    }

    /**
     * @return array
     */
    public function getAppConfigPath()
    {
        return $this->appConfigPath;
    }

    /**
     * @param array $appConfigPath
     */
    public function setAppConfigPath($appConfigPath)
    {
        $this->appConfigPath = $appConfigPath;
    }

    // Methods to instantiate from app container
    /**
     * @return array
     */
    public function getApp()
    {
        return $this->app;
    }
    /**
     * @param array $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }
    /**
     * @return array
     */
    public function getAppConfigFile()
    {
        return $this->appConfigFile;
    }
    /**
     * @param array $appConfigFile
     */
    public function setAppConfigFile($appConfigFile)
    {
        $this->appConfigFile = $appConfigFile;
    }
}