<?php

namespace Spider\Mixins\Element;


trait HasClassAttribute {
    public function addClass(string ...$classes): self {
        $currentClasses = $this->node->getAttribute("class");
    
        $newClasses = trim($currentClasses . " " . implode(" ", $classes));

        $this->node->setAttribute("class", $newClasses);
    

        return $this;
    }

    public function removeClass(string ...$classes): self {
        $currentClasses = $this->node->getAttribute("class");

        $newClasses = "";

        foreach ($classes as $class) {
            $newClasses = str_replace($class, "", $currentClasses);
        }

        $this->node->setAttribute("class", trim($newClasses));


        return $this;
    }

    public function hasClass(string $class): bool {
        $currentClasses = $this->node->getAttribute("class");
        
        $classes = explode(" ", $currentClasses);

        return in_array($class, $classes) ? true : false;
    }
}

trait HasIdAttribute {
    public function addID(string $id): self {
        $this->node->setAttribute("id", $id);

        return $this;
    }

    public function removeID(): self {
        $this->node->removeAttribute("id");

        return $this;
    }

    public function hasID(string $id): bool {
        $currentID = $this->node->getAttribute("id");
        
        if (!$currentID) return false;

        return $currentID === $id ? true : false;
    }
}

trait HasMetaAttribute {
    private function addAttribute(string $attribute, array $values): void {
        $this->node->setAttribute($attribute, implode(" ", $values));
    }
}


trait HasAttribute {
    use HasClassAttribute, HasIdAttribute, HasMetaAttribute;

    public function attr(string $key = null, string ...$values): string|array|null {
        $attributes = [];

        foreach ($this->node->attributes as $attribute) {
            if (isset($key) && count($values)) $this->addAttribute($key, $values);
            
            if (isset($key) && $attribute->nodeName === $key) return $attribute->textContent;
            
            if (isset($key) && $attribute->nodeName !== $key) return null;


            $attributes[$attribute->nodeName] = $attribute->nodeValue;
        }

        return $attributes;
    }
}