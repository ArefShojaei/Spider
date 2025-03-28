<?php

namespace Spider\Mixins\Spider;

use Exception;
use Spider\Page;


trait HasLoader {
    /**
     * @param string $content HTML content
     */
    public function loadHTML(string $content): Page {
        try {
            [$dom, $xpath] = $this->createDOM($content);
        
            return new Page($dom, $xpath);
        } catch (Exception $error) {
            throw new Exception("[ERROR] HTML Loader: " . $error->getMessage());
        }
    }

    /**
     * @param string $src HTML file
     */
    public function loadFile(string $src): Page {
        try {
            $content = file_get_contents($src);

            [$dom, $xpath] = $this->createDOM($content);

            return new Page($dom, $xpath);
        } catch (Exception $error) {
            throw new Exception("[ERROR] File Loader: " . $error->getMessage());
        }
    }
}