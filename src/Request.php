<?php

namespace Spider;


final class Request {
    public static function get(string $url): string|false {
        return @file_get_contents($url);
    }
}