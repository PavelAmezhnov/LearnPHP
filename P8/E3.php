<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=LearnPHP', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  $query = 'SELECT `dish_name` FROM `dishes`';
  $rows = $db->query($query)->fetchAll();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dish = $db->quote($_POST['dishes']);
    $dish = strtr($dish, array('_' => '\_', '%' => '\%'));

    $query = 'SELECT * FROM `dishes` WHERE `dish_name` LIKE ' . $dish;
    $choice = $db->query($query)->fetch();
    }
} catch (PDOException $e) {
  print $e->getMessage();
  exit();
}

$html =
<<<_FORM_
  <form method="POST" action="{$_SERVER['PHP_SELF']}">
    <div>
      <span>Выберите блюдо</span>
      <select name="dishes">
_FORM_;

if ($rows) {
  foreach ($rows as $row) {
    $html .= '<option>' . $row->dish_name . '</option>';
  }
}

$html .=
<<<_FORM_
      </select>
    </div>
    <div>
      <button type="submit" name="submit" value="submit">Выбор</button>
    </div>
  </form>
_FORM_;

if ($choice) {
  if ($choice->is_spice) {
    $is_spicy = 'Да';
  } else {
    $is_spicy = 'Нет';
  }
  $html .= '<table><tr><th>ID</th><th>Название</th><th>Цена</th><th>Специи?</th></tr>';
  $html .= "<tr><td>{$choice->id}</td><td>{$choice->dish_name}</td><td>{$choice->price}</td><td>$is_spicy</td></tr></table>";
}

print $html;
