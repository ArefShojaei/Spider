<img src="https://github.com/user-attachments/assets/4d307a59-9eff-4513-a2cc-f16375174244" />

<h1 align='center'>PHP web spider</h1>

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