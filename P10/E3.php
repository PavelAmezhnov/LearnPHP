<?php
session_start();

$colors = [
  'FF0000' => 'Красный',
  '00FF00' => 'Зеленый',
  '0000FF' => 'Синий'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $input = $_POST['color'];
  if (array_key_exists($input, $colors)) {
    $_SESSION['bg_color'] = $input;
  } else {
    $error = 'Выберите цвет из предложенных';
  }
}

$form = <<<_HTML_
<form method="POST" action="{$_SERVER['PHP_SELF']}">
  <div>
    <span>Выберите цвет</span>
    <select name="color">
_HTML_;

foreach ($colors as $k => $value) {
  $form .= "<option value=\"$k\">$value</option>";
}

$form .= <<<_HTML_
    </select>
  </div>
  <div>
    <button type="submit" name="submit" value="submit">Выбрать</button>
  </div>
</form>
_HTML_;

print $form;
