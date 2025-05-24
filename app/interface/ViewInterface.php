<?php

namespace App\interface;

interface ViewInterface
{
    /**
     * Render a view file with the given data.
     *
     * @param string $view The name of the view file to render.
     * @param array $data An associative array of data to pass to the view.
     * @return string The rendered view content.
     */
    public function render(string $view, array $data = []): string;

    /**
     * Get the path to a specific view file.
     *
     * @param string $view The name of the view file.
     * @return string The full path to the view file.
     */
    public function getViewPath(string $view): string;

    /**
     * Get the path to a specific layout file.
     *
     * @param string $layout The name of the layout file.
     * @return string The full path to the layout file.
     */
    public function getLayoutPath(string $layout): string;
    /**
     * Get the path to a specific partial file.
     *
     * @param string $partial The name of the partial file.
     * @return string The full path to the partial file.
     */

    public function getPartialPath(string $partial): string;
    /**
     * Get the path to a specific component file.
     *
     * @param string $component The name of the component file.
     * @return string The full path to the component file.
     */

    public function getComponentPath(string $component): string;
    /**
     * Get the path to a specific block file.
     *
     * @param string $block The name of the block file.
     * @return string The full path to the block file.
     */

    public function getBlockPath(string $block): string;
    /**
     * Get the path to a specific template file.
     *
     * @param string $template The name of the template file.
     * @return string The full path to the template file.
     */

    public function getTemplatePath(string $template): string;
    /**
     * Get the path to a specific asset file.
     *
     * @param string $asset The name of the asset file.
     * @return string The full path to the asset file.
     */

    public function getAssetPath(string $asset): string;
    /**
     * Get the path to a specific script file.
     *
     * @param string $script The name of the script file.
     * @return string The full path to the script file.
     */

    public function getScriptPath(string $script): string;
    /**
     * Get the path to a specific style file.
     *
     * @param string $style The name of the style file.
     * @return string The full path to the style file.
     */

    public function getStylePath(string $style): string;
    /**
     * Get the path to a specific image file.
     *
     * @param string $image The name of the image file.
     * @return string The full path to the image file.
     */

    public function getImagePath(string $image): string;
    /**
     * Get the path to a specific font file.
     *
     * @param string $font The name of the font file.
     * @return string The full path to the font file.
     */

    public function getFontPath(string $font): string;
    /**
     * Get the path to a specific video file.
     *
     * @param string $video The name of the video file.
     * @return string The full path to the video file.
     */

    public function getVideoPath(string $video): string;
    /**
     * Get the path to a specific audio file.
     *
     * @param string $audio The name of the audio file.
     * @return string The full path to the audio file.
     */

    public function getAudioPath(string $audio): string;
    /**
     * Get the path to a specific document file.
     *
     * @param string $document The name of the document file.
     * @return string The full path to the document file.
     */

    public function getDocumentPath(string $document): string;
    /**
     * Get the path to a specific configuration file.
     *
     * @param string $config The name of the configuration file.
     * @return string The full path to the configuration file.
     */

    public function getConfigPath(string $config): string;
    /**
     * Get the path to a specific language file.
     *
     * @param string $language The name of the language file.
     * @return string The full path to the language file.
     */

    public function getLanguagePath(string $language): string;
    /**
     * Get the path to a specific log file.
     *
     * @param string $log The name of the log file.
     * @return string The full path to the log file.
     */

    public function getLogPath(string $log): string;
    /**
     * Get the path to a specific cache file.
     *
     * @param string $cache The name of the cache file.
     * @return string The full path to the cache file.
     */

    public function getCachePath(string $cache): string;
    /**
     * Get the path to a specific migration file.
     *
     * @param string $migration The name of the migration file.
     * @return string The full path to the migration file.
     */

    
}