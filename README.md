<div align="center">
    <img src="https://github.com/user-attachments/assets/4d307a59-9eff-4513-a2cc-f16375174244" width="400px" height="400px" />
</div>

<h1 align='center'>
    PHP web spider
</h1>

```php
<?php

use Spider\Spider;

$spider = new Spider;

$page = $spider->loadHTML("http://google.com");

echo $page->find("title")->text() . PHP_EOL;

$page->findAll("a")->each(function($key, $link) {
    echo "[LINK] " . $link->attr("href") . PHP_EOL;
});
```
<br/>

## **Installation**

#### Using Composer
```bash
composer create-project arefshojaei/spider
```

#### Using GIT
```bash
git clone https://github.com/ArefShojaei/Spider
```



> Find element
* find()
* findAll()

```php
$page->find("a");

$page->findAll(".product");
```

> Iterate for each eleemnt
* each()
* map()
* filter()

```php
$page->findAll("a")->each(function($key, $anchor) {
    echo "[LINK] " . $anchor->attr("href") . PHP_EOL;
    echo "[TITLE] " . $anchor->text() . PHP_EOL;
    echo "[HTML] " . $anchor->html() . PHP_EOL;
});

# ----------------------------------------
$anchors = $page->findAll("a")->map(function($key, $anchor) {
    $anchor->attr("data-id", rand());

    return $anchor;
});

var_dump($anchors);

# ----------------------------------------
$filteredAnchors = $page->findAll("a")->filter(function($key, $anchor) => $anchor->attr("data-id")); 

var_dump($filteredAnchors);
```


> Element traversing
* parent()
* after()
* before()
* append()
* prepend()

```php
$parentNode = $page->find(".product")->parent();

# Add parent Element
$page->find(".product")->after("<p>After Element</p>");
$page->find(".product")->before("<p>Before Element</p>");

# Add child (local) element
$page->find(".product")->append("<p>Append Element</p>");
$page->find(".product")->prepend("<p>Prepend Element</p>");
```

> Element cleaner
* empty()
* remove()

```php
# Clean element content
$page->find("p")->empty();

# Remove element from the DOM
$page->find("p")->remove();
```

> Element content
* text()
* html()

```php
# Getter
$text = $page->find("p")->text();
$html = $page->find("p")->html();

# Setter
$newText = $page->find("p")->text("New text content");
$newHtml = $page->find("p")->html("<p id='spider'>New html content</p>");
```

> Element attribute
* attr()
* addClass()
* removeClass()
* hasClass()
* addId()
* removeId()
* hasId()

```php
# Getter
$attributes = $page->find("a")->attr();

$link = $page->find("a")->attr("href");

# Setter
$page->find("a")->attr("data-id", rand());

# Class
$page->find("p")->addClass("spider");
$page->find("p")->removeClass("spider");
$page->find("p")->hasClass("spider");

# ID
$page->find("p")->addID("spider");
$page->find("p")->removeID("spider");
$page->find("p")->hasID("spider");
```


> Export current page content
```php
$filename = "app";

$path = __DIR__ . "\\html\\" . $filename . rand() . ".html";

$page->export($path);
```
