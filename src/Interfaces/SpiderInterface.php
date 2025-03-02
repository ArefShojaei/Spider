<?php

namespace Spider\Interfaces;

use Spider\Page;


interface LoaderInterface {
    public function loadHTML(string $url): Page;
    
    public function loadFile(string $src): Page;
}

interface SpiderInterface extends LoaderInterface {}