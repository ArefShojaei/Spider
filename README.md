<div align="center">
    <img width="420"  alt="logo" src="https://github.com/user-attachments/assets/cbdec017-c2c0-48cf-8def-9466bf479be7" />


# 🕷️ Spider - PHP Web Crawler & HTML Parser

A lightweight and powerful PHP web crawler inspired by jQuery-style DOM manipulation.

Fetch web pages, parse HTML documents, search elements with CSS selectors, manipulate the DOM, and export modified pages with an elegant and simple API.

</div>

---

## ✨ Features

* 🌐 Load and parse any HTML web page
* 🔍 CSS selector-based element searching
* 📄 Extract text, HTML, and attributes
* 🔁 Iterate over multiple DOM elements
* 🧹 Remove and clean HTML elements
* 🏗️ Modify the DOM structure dynamically
* 🎨 Manage CSS classes and IDs
* 💾 Export modified HTML documents
* ⚡ Lightweight and dependency-free PHP implementation

---

# 📥 Installation

## Install with Composer

```bash
composer require arefshojaei/spider
```

## Clone from GitHub

```bash
git clone https://github.com/ArefShojaei/Spider.git
cd Spider
```

---

# 🚀 Quick Start

Fetch a page and extract its content:

```php
<?php

use Spider\Spider;

$spider = new Spider();

$page = $spider->loadHTML("https://google.com");

echo $page->find("title")->text() . PHP_EOL;

$page->findAll("a")->each(function ($key, $link) {
    echo "[LINK] " . $link->attr("href") . PHP_EOL;
});
```

---

# 🔎 Finding Elements

Search DOM elements using CSS selectors.

## Find a single element

```php
$page->find("a");
$page->find(".product");
$page->find("#header");
```

## Find multiple elements

```php
$page->findAll("a");
$page->findAll(".product");
```

---

# 🔁 Iterating Elements

Perform operations on element collections.

## each()

Loop through every element:

```php
$page->findAll("a")->each(function ($key, $anchor) {
    echo $anchor->text();
});
```

## map()

Transform elements:

```php
$anchors = $page->findAll("a")->map(function ($key, $anchor) {
    $anchor->attr("data-id", rand());

    return $anchor;
});
```

## filter()

Filter elements by a condition:

```php
$links = $page->findAll("a")->filter(
    fn($key, $anchor) => $anchor->attr("href")
);
```

---

# 🌳 DOM Traversing

Navigate and modify element relationships.

## Parent element

```php
$parent = $page->find(".product")->parent();
```

## Insert sibling elements

```php
$page->find(".product")
     ->before("<p>Before Element</p>");

$page->find(".product")
     ->after("<p>After Element</p>");
```

## Insert child elements

```php
$page->find(".product")
     ->append("<p>New Child</p>");

$page->find(".product")
     ->prepend("<p>First Child</p>");
```

---

# 🧹 Cleaning Elements

Remove content or complete elements.

## Empty content

```php
$page->find("p")->empty();
```

## Remove element

```php
$page->find("p")->remove();
```

---

# 📄 Working with Content

## Get text or HTML

```php
$text = $page->find("p")->text();

$html = $page->find("p")->html();
```

## Update content

```php
$page->find("p")->text("New text");

$page->find("p")->html("<strong>New HTML</strong>");
```

---

# 🏷️ Working with Attributes

## Read attributes

```php
$attributes = $page->find("a")->attr();

$link = $page->find("a")->attr("href");
```

## Set attributes

```php
$page->find("a")->attr("data-id", 123);
```

---

# 🎨 CSS Classes & IDs

## Classes

```php
$page->find("p")->addClass("active");

$page->find("p")->removeClass("active");

$page->find("p")->hasClass("active");
```

## IDs

```php
$page->find("p")->addID("article");

$page->find("p")->removeID("article");

$page->find("p")->hasID("article");
```

---

# 💾 Export HTML

Save the current DOM document to a file.

```php
$filename = "page";

$path = __DIR__ . "/html/" . $filename . rand() . ".html";

$page->export($path);
```

---

# 💡 Example Use Cases

Spider can be used for:

* Web scraping and data extraction
* SEO analysis
* Content migration
* HTML cleaning and transformation
* Static website processing
* Automated testing of HTML pages
* Learning how browser DOM engines work

---

# 🔥 Why Spider?

Spider brings the simplicity of jQuery-style DOM APIs into PHP.

Instead of dealing with complex DOMDocument operations, you can navigate and manipulate HTML documents using a clean and expressive syntax.

It is a great educational project for learning:

* Web crawling concepts
* HTML parsing
* DOM tree manipulation
* CSS selector engines
* Collection processing
* Parser design

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository

2. Create a feature branch:

```bash
git checkout -b feature/amazing-feature
```

3. Commit your changes:

```bash
git commit -m "Add amazing feature"
```

4. Push your branch:

```bash
git push origin feature/amazing-feature
```

5. Open a Pull Request.

---

# 👨‍💻 Author

**Aref Shojaei**
- 📧 Email: [arefshojaei82@gmail.com](mailto:arefshojaei82@gmail.com)
- 🐙 GitHub: [@ArefShojaei](https://github.com/ArefShojaei)
- 📦 Packagist: [arefshojaei/spider](https://packagist.org/packages/arefshojaei/Spider)

---

# ⭐ Show Your Support

If this project helps you understand web crawling, HTML parsing, and DOM manipulation, consider giving it a **Star ⭐ on GitHub**.

Your support motivates future improvements.
