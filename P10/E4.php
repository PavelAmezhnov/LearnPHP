<?php
session_start();

$main_dishes = [
  'cuke' => 'Braised Sea Cucumber',
  'stomach' => "Sauteed  Pig's  Stomach" ,
  'tripe' => 'Sauteed Tripe with Wine Sauce',
  'taro' => 'Stewed Pork with Taro' ,
  'giblets' => 'Baked Giblets with Salt',
  'abalone' => 'Abalone with Marrow and Duck Feet'
];

$order = array();
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($main_dishes as $k => $v) {
    if (FALSE !== filter_input(INPUT_POST, $k, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 9]])) {
      if ($_POST[$k] !== '0') {
        $order[$v] = $_POST[$k];
      }
    } else {
      $errors[$k] = 'Количество должно быть от нуля до девяти';
    }
  }

  if (empty($errors) && (! empty($order))) {
    $_SESSION['order'] = $order;
    $result = '<h4>Заказ сохранен<h4>';
  } else {
    $result = '<h4>Ничего не заказано или ошибки<h4>';
  }
}

$form = <<<_FORM_
<form method="POST" action="{$_SERVER['PHP_SELF']}"
  <p>
    <span>Введите количество товаров</span>
  </p>
_FORM_;

foreach ($main_dishes as $k => $v) {
  $count = $_SESSION['order'][$v] ?? '0';
  $form .= "<p><label>$v <input type=\"text\" name=\"$k\" value=\"$count\"> {$errors[$k]}</label></p>";
}

$form .= <<<_FORM_
  <p>
    <button type="submit" name="submit" value="submit">Отправить</button>
  </p>
</form>
_FORM_;

$form .= $result;

print $form;
