<?php

namespace Spider\Interfaces;

use Spider\Page;


interface SpiderInterface {
    public function loadHTML(): Page;
}