<?php

namespace Spider;

use DOMDocument;
use DOMXPath;
use Spider\Interfaces\SpiderInterface;
use Spider\Mixins\Spider\HasLoader;


final class Spider implements SpiderInterface {
    use HasLoader;

    private function createDOM(string $content): array {
        $dom = new DOMDocument(encoding: "UTF-8");
                
        @$dom->loadHTML($content);
    
        $xpath = new DOMXPath($dom);

        return [$dom, $xpath];
    }
}