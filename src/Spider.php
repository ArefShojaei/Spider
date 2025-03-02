<?php

namespace Spider;

use DOMDocument;
use DOMXPath;
use Exception;
use Spider\{
    Page,
    Request,
    Interfaces\SpiderInterface
};


final class Spider implements SpiderInterface {
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

    private function createDOM(string $content): array {
        $dom = new DOMDocument(encoding: "UTF-8");
                
        @$dom->loadHTML($content);
    
        $xpath = new DOMXPath($dom);

        return [$dom, $xpath];
    }
}