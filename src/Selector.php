<?php

namespace Spider;

use Spider\Interfaces\SelectorInterface;


class Selector implements SelectorInterface {
    private const RELATIVE_AXIS = "//"; 

    private const ABSOLUTE_AXIS = "/"; 

    private static string $selector;


    public static function convert(string $selector): string {
        self::$selector = trim($selector);
        
        self::transformTags();

        self::transformAttributes();
        
        self::transformChildren();
        
        self::transformPassports();

        return self::RELATIVE_AXIS . self::$selector;
    }

    private static function transformTags(): void {
        $selector = self::$selector;

        $selector = preg_replace('/\s+/', ' ', $selector);
        $selector = preg_replace('/\s+>\s*/', self::ABSOLUTE_AXIS, $selector);
        $selector = preg_replace('/\s+/', self::RELATIVE_AXIS, $selector);

        $selector = preg_replace('/\s+\~\s*(\w+)\s*/', '/following-sibling::$1', $selector);
        $selector = preg_replace('/\s+\+\s*(\w+)\s*/', '/following-sibling::$1[1]', $selector);

        self::$selector = $selector;
    }

    private static function transformAttributes(): void {
        $selector = self::$selector;

        $selector = preg_replace("/(\w+)\[(\w+)\]/", "$1[@$2]", $selector);
        $selector = preg_replace("/(\w+)\[(\w+)=[\"\'](\w+)[\"\']\]/", "$1[@$2=\"$3\"]", $selector);
        $selector = preg_replace("/(\w+)\[(\w+)^=[\"\'](\w+)[\"\']\]/", "$1[@starts-with(@$2, \"$3\")]", $selector);
        $selector = preg_replace("/(\w+)\[(\w+)$=[\"\'](\w+)[\"\']\]/", "$1[@ends-with(@$2, \"$3\")]", $selector);
        $selector = preg_replace("/(\w+)\[(\w+)*=[\"\'](\w+)[\"\']\]/", "$1[@contains(@$2, \"$3\")]", $selector);
        $selector = preg_replace("/(\w+)\[(\w+)~=[\"\'](\w+)[\"\']\]/", "$1[@contains(@$2, \"$3\")]", $selector);
        $selector = preg_replace("/:not\((\w+)\)/", "[@not(@$1)]", $selector);
    
        self::$selector = $selector;
    }

    private static function transformPassports(): void {
        $selector = self::$selector;

        $selector = preg_replace('/\#(\w+)/', '*[@id="$1"]', $selector);
        $selector = preg_replace('/\.(\w+)/', '*[@class="$1"]', $selector);

        self::$selector = $selector;
    }

    private static function transformChildren(): void {
        $selector = self::$selector;

        $selector = preg_replace("/:nth-child\((\d+)\)/", "[$1]", $selector);
        $selector = preg_replace("/(\w+):first-child/", "*[1][name()=\"$1\"]", $selector);
        $selector = preg_replace("/(\w+):last-child/", "*[last()][name()=\"$1\"]", $selector);

        self::$selector = $selector;
    }
}
