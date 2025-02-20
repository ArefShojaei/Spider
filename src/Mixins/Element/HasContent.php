<?php

namespace Spider\Mixins\Element;


trait HasContent {
    public function text(?string $value = null): string|bool {
        if (!is_null($value)) return $this->setText($value);
        
        return trim($this->node->textContent);
    }

    public function html(?string $value = null): string|bool {
        if (!is_null($value)) return $this->setHtml($value);

        return trim($this->dom->saveHTML($this->node));
    }

    private function setText(string $value): bool {
        $this->node->nodeValue = $value;
        $this->node->textContent = $value;

        return true;
    }

    private function setHtml(string $html): bool {
        $fragmentNode = $this->dom->createDocumentFragment();

        $fragmentNode->appendXML($html);

        $this->node->parentNode->replaceChild($fragmentNode, $this->node);

        return true;
    }
}