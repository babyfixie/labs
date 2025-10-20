<?php

// 1. Інтерфейс Renderer
interface Renderer
{
  public function renderTitle($title);
  public function renderTextBlock($text);
  public function renderImage($url);
  public function renderLink($url, $title);
  public function renderParts($parts);
}

// 2. Реалізації Renderer

class HTMLRenderer implements Renderer
{
  public function renderTitle($title)
  {
    return "<h1>$title</h1>";
  }

  public function renderTextBlock($text)
  {
    return "<p>$text</p>";
  }

  public function renderImage($url)
  {
    return "<img src='$url' />";
  }

  public function renderLink($url, $title)
  {
    return "<a href='$url'>$title</a>";
  }

  public function renderParts($parts)
  {
    return implode("\n", $parts);
  }
}

class JsonRenderer implements Renderer
{
  public function renderTitle($title)
  {
    return array('type' => 'title', 'content' => $title);
  }

  public function renderTextBlock($text)
  {
    return array('type' => 'text', 'content' => $text);
  }

  public function renderImage($url)
  {
    return array('type' => 'image', 'url' => $url);
  }

  public function renderLink($url, $title)
  {
    return array('type' => 'link', 'title' => $title, 'url' => $url);
  }

  public function renderParts($parts)
  {
    return json_encode($parts);

  }
}


class XmlRenderer implements Renderer
{
  public function renderTitle($title)
  {
    return "<title>$title</title>";
  }

  public function renderTextBlock($text)
  {
    return "<text>$text</text>";
  }

  public function renderImage($url)
  {
    return "<image src=\"$url\" />";
  }

  public function renderLink($url, $title)
  {
    return "<link href=\"$url\">$title</link>";
  }

  public function renderParts($parts)
  {
    return "<content>" . implode("", $parts) . "</content>";
  }
}

// 3. Абстрактна сторінка

abstract class Page
{
  protected $renderer;

  public function __construct($renderer)
  {
    $this->renderer = $renderer;
  }

  abstract public function render();
}

// 4. Проста сторінка

class SimplePage extends Page
{
  protected $title;
  protected $content;

  public function __construct($title, $content, $renderer)
  {
    parent::__construct($renderer);
    $this->title = $title;
    $this->content = $content;
  }

  public function render()
  {
    return $this->renderer->renderParts(array(
      $this->renderer->renderTitle($this->title),
      $this->renderer->renderTextBlock($this->content)
    ));
  }
}

// 5. Товар + сторінка товару

class Product
{
  public $id;
  public $name;
  public $description;
  public $imageUrl;

  public function __construct($id, $name, $description, $imageUrl)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->imageUrl = $imageUrl;
  }
}

class ProductPage extends Page
{
  protected $product;

  public function __construct($product, $renderer)
  {
    parent::__construct($renderer);
    $this->product = $product;
  }

  public function render()
  {
    return $this->renderer->renderParts(array(
      $this->renderer->renderTitle($this->product->name),
      $this->renderer->renderTextBlock($this->product->description),
      $this->renderer->renderImage($this->product->imageUrl),
      $this->renderer->renderLink("/product/" . $this->product->id, "View Product")
    ));
  }
}

// 6. Приклади використання

$htmlRenderer = new HTMLRenderer();
$jsonRenderer = new JsonRenderer();
$xmlRenderer = new XmlRenderer();

echo "----- [HTML] -----\n";
$simpleHtml = new SimplePage("Hello", "This is simple page", $htmlRenderer);
echo $simpleHtml->render();
echo "\n\n";

echo "----- [JSON] -----\n";
$product = new Product("123", "Phone", "Phone with camera", "image.jpg");
$productJson = new ProductPage($product, $jsonRenderer);
echo $productJson->render();
echo "\n\n";

echo "----- [XML] -----\n";
$simpleXml = new SimplePage("XML Title", "XML Content", $xmlRenderer);
echo $simpleXml->render();

?>