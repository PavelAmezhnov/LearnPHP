<?php
$html =
<<<_FORM_
  <form method="POST" action="{$_SERVER['PHP_SELF']}">
    <div>
      <span>Введите минимальную цену блюд</span>
      <input type="text" name="min_price">
    </div>
    <div>
      <button type="submit" name="submit" value="find">Найти</button>
    </div>
  </form>
_FORM_;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $input = trim(htmlentities($_POST['min_price']));

  if ((filter_var($input, FILTER_VALIDATE_FLOAT) !== FALSE) && $input >= 0) {
    try {
      $db = new PDO('mysql:host=localhost;dbname=LearnPHP', 'root', '');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $query = 'SELECT `dish_name`, `price` FROM `dishes` WHERE `price` >= ? ORDER BY `price`';
      $stmt = $db->prepare($query);
      $stmt->execute(array($input));
      $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

      if (count($rows)) {
        $html .= '<table><tr><th>Название</th><th>Цена</th></tr>';
        foreach ($rows as $row) {
          $html .= "<tr><td>$row->dish_name</td><td>$row->price</td></tr>";
        }
        $html .= '</table>';
      } else {
       $html .= "<h3>Нет блюд дороже {$input}$</h3>";
      }
    } catch (PDOException $e) {
      print $e->getMessage();
      exit();
    }
  } else {
    $html .= '<h3>Введите корректное число</h3>';
  }
}

print $html;
