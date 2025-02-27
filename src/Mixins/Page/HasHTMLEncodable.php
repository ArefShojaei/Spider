<?php

namespace Spider\Mixins\Page;


trait HasHTMLEncodable {
    private function decodeHTML(string $html): string {
        return html_entity_decode($html, encoding:"UTF-8");
    }
}