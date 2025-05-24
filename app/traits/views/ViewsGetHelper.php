<?php

namespace App\traits\views;

trait ViewsGetHelper
{
    
    
    public function getConfigPath(string $config): string
    {
        return BASE_PATH . '/config/' . $config . '.php'; // Assuming config files are stored in a directory named 'config'
    }

    public function getLanguagePath(string $language): string
    {
        return BASE_PATH . '/languages/' . $language . '.php'; // Assuming language files are stored in a directory named 'languages'
    }

    public function getLogPath(string $log): string
    {
        return BASE_PATH . '/logs/' . $log . '.log'; // Assuming log files are stored in a directory named 'logs'
    }
    public function getCachePath(string $cache): string
    {
        return BASE_PATH . '/cache/' . $cache . '.cache'; // Assuming cache files are stored in a directory named 'cache'
    }



    public function getViewPath(string $view): string
    {
        return $this->viewPath . $view . '.php';
    }

    public function getLayoutPath(string $layout): string
    {
        return $this->layoutPath . $layout . '.php';
    }

    public function getPartialPath(string $partial): string
    {
        return $this->partialPath . $partial . '.php';
    }

    public function getComponentPath(string $component): string
    {
        return $this->componentPath . $component . '.php';
    }

    public function getBlockPath(string $block): string
    {
        return $this->blockPath . $block . '.php';
    }

    public function getTemplatePath(string $template): string
    {
        return $this->templatePath . $template . '.php';
    }

    public function getAssetPath(string $asset): string
    {
        return BASE_PATH . '/public/assets/' . $asset; // Assuming assets are stored in a directory named 'assets'
    }
    public function getScriptPath(string $script): string
    {
        return BASE_PATH . '/public/assets/scripts/' . $script; // Assuming scripts are stored in a directory named 'scripts'
    }

    public function getStylePath(string $style): string
    {
        return BASE_PATH . '/public/assets/styles/' . $style; // Assuming styles are stored in a directory named 'styles'
    }

    public function getImagePath(string $image): string
    {
        return BASE_PATH . '/public/assets/images/' . $image; // Assuming images are stored in a directory named 'images'
    }
    public function getFontPath(string $font): string
    {
        return BASE_PATH . '/public/assets/fonts/' . $font; // Assuming fonts are stored in a directory named 'fonts'
    }

    public function getVideoPath(string $video): string
    {
        return BASE_PATH . '/public/assets/videos/' . $video; // Assuming videos are stored in a directory named 'videos'
    }

    public function getAudioPath(string $audio): string
    {
        return BASE_PATH . '/public/assets/audio/' . $audio; // Assuming audio files are stored in a directory named 'audio'
    }

    public function getDocumentPath(string $document): string
    {
        return BASE_PATH . '/public/assets/documents/' . $document; // Assuming documents are stored in a directory named 'documents'
    }

    public function getPath(string $type, string $name): string
    {
        switch ($type) {
            case 'view':
                return $this->getViewPath($name);
            case 'layout':
                return $this->getLayoutPath($name);
            case 'partial':
                return $this->getPartialPath($name);
            case 'component':
                return $this->getComponentPath($name);
            case 'block':
                return $this->getBlockPath($name);
            case 'template':
                return $this->getTemplatePath($name);
            case 'asset':
                return $this->getAssetPath($name);
            case 'script':
                return $this->getScriptPath($name);
            case 'style':
                return $this->getStylePath($name);
            case 'image':
                return $this->getImagePath($name);
            case 'font':
                return $this->getFontPath($name);
            case 'video':
                return $this->getVideoPath($name);
            case 'audio':
                return $this->getAudioPath($name);
            case 'document':
                return $this->getDocumentPath($name);
            default:
                throw new \Exception("Unknown type: " . $type);
        }
    }

    public function getAssetUrl(string $asset): string
    {
        return '/assets/' . $asset; // Assuming assets are served from a public directory
    }

}