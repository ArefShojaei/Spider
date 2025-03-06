<?php

namespace Spider\Mixins\Spider;

use Exception;
use Spider\{
    Page,
    Request,
};


trait HasLoader {
    public function loadHTML(string $url): Page {
        try {
            $content = Request::get($url);

            [$dom, $xpath] = $this->createDOM($content);
        
            return new Page($dom, $xpath);
        } catch (Exception $error) {
            throw new Exception("[ERROR] HTML Loader: " . $error->getMessage());
        }
    }

    public function loadFile(string $src): Page {
        try {
            $content = Request::get($src);

            [$dom, $xpath] = $this->createDOM($content);

            return new Page($dom, $xpath);
        } catch (Exception $error) {
            throw new Exception("[ERROR] File Loader: " . $error->getMessage());
        }
    }
}