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

        $selector = preg_replace('/\s+/', ' ', $selector); # Normilize whitespaces
        
        $selector = preg_replace('/\s+\~\s*([\w_-]+)\s*/', '/following-sibling::$1', $selector); # parent ~ child
        $selector = preg_replace('/\s+\+\s*([\w_-]+)\s*/', '/following-sibling::$1[1]', $selector); # paretn * child
        
        $selector = preg_replace('/\s+>\s*/', self::ABSOLUTE_AXIS, $selector); # parent > child
        $selector = preg_replace('/\s+/', self::RELATIVE_AXIS, $selector); # parent


        self::$selector = $selector;
    }

    private static function transformAttributes(): void {
        $selector = self::$selector;

        $selector = preg_replace("/([\w_-]+)\[([\w_-]+)\]/", "$1[@$2]", $selector); # input[attr]
        $selector = preg_replace("/([\w_-]+)\[([\w_-]+)\s*=[\"\']([\w_-]+)[\"\']\]/", "$1[@$2=\"$3\"]", $selector); # input[attr=value]
        $selector = preg_replace("/([\w_-]+)\[([\w_-]+)\$\s*=[\"\']([\w_-]+)[\"\']\]/", "$1[ends-with(@$2, \"$3\")]", $selector); # input[attr$=value]
        $selector = preg_replace("/([\w_-]+)\[([\w_-]+)\^\s*=[\"\']([\w_-]+)[\"\']\]/", "$1[starts-with(@$2, \"$3\")]", $selector); # input[attr^=value]
        $selector = preg_replace("/([\w_-]+)\[([\w_-]+)\*\s*=[\"\']([\w_-]+)[\"\']\]/", "$1[contains(@$2, \"$3\")]", $selector); # input[attr*=value]
        $selector = preg_replace("/([\w_-]+)\[([\w_-]+)\~\s*=[\"\']([\w_-]+)[\"\']\]/", "$1[contains(@$2, \"$3\")]", $selector); # input[attr~=value]
    
        self::$selector = $selector;
    }

    private static function transformPassports(): void {
        $selector = self::$selector;

        $selector = preg_replace('/([\w_-]+)\#([\w_-]+)/', '$1[@id="$2"]', $selector); #     element#id
        $selector = preg_replace('/\#([\w_-]+)/', '*[@id="$1"]', $selector); #     #id
        
        $selector = preg_replace('/([\w_-]+)\.([\w_-]+)/', '$1[contains(@class, "$1")]', $selector); #  element.class
        $selector = preg_replace('/\.([\w_-]+)/', '*[contains(@class, "$1")]', $selector); #  .class

        self::$selector = $selector;
    }

    private static function transformChildren(): void {
        $selector = self::$selector;

        $selector = preg_replace("/([\w_-]+):nth-child\((.+)\)/", "$1[position()=\"$2\"]", $selector); # :nth-child(n)
        $selector = preg_replace("/([\w_-]+):first-child/", "*[1][name()=\"$1\"]", $selector); # :first-child
        $selector = preg_replace("/([\w_-]+):last-child/", "*[last()][name()=\"$1\"]", $selector); # :last-child
        $selector = preg_replace("/:not\(([\w_-]+)\)/", "[@not(@$1)]", $selector); # parent children:not(child)

        self::$selector = $selector;
    }
}
