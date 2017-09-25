<?php
namespace Ingres;

require './E4.php';

class Entree
{
  public $name;
  public $ingredients = array();

  public function __construct($name, $ingredients)
  {
    if (! is_array($ingredients)) {
     throw new Exception('$ingredients must Ье an array');
    }
    $this->name = $name;
    $this->ingredients = $ingredients;
  }

  public function hasIngredient($ingredient)
  {
    return in_array($ingredient,  $this->ingredients);
  }
}

class Dish extends Entree
{
  public function __construct(string $name, array $ingredients)
  {
    parent::__construct($name, $ingredients);
    foreach ($ingredients as $ingredient) {
      if (! $ingredient instanceof Ingredient) {
        throw new Exception('Элементы $ingredients должны быть экземплярами Ingredient');
      }
    }
  }

  public function get_total_price()
  {
    $total_price = 0;
    for ($i = 0, $count = count($this->ingredients); $i < $count; $i++) {
      $total_price += $this->ingredients[$i]->get_price();
    }
    return $total_price;
  }
}

$milk = new Ingredient('milk', 99.9);

$salt = new Ingredient('salt', 1.99);

$salted_milk = new Dish('salted milk', [$milk, $salt]);

print $salted_milk->get_total_price();
