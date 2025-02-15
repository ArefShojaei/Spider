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
    private $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function loadHTML(): Page {
        try {
            $content = Request::get($this->url);

            $dom = new DOMDocument(encoding: "UTF-8");
                
            @$dom->loadHTML($content);
        
            $xpath = new DOMXPath($dom);
        

            return new Page($dom, $xpath);
        } catch (Exception $error) {
            throw new Exception("[ERROR] " . $error->getMessage());
        }
    }
}