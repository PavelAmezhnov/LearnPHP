<?php
namespace Ingres;

class Ingredient
{
  protected $name;
  protected $price;

  public function __construct($name, $price)
  {
    $this->name = $name;
    $this->price = $price;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function get_price()
  {
    return $this->price;
  }

  public function change_price($new_price)
  {
    if ($this->price != $new_price) {
      $this->price = $new_price;
    }
  }
}
