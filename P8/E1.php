<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=LearnPHP', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = 'SELECT * FROM `dishes` ORDER BY `price`';
  $rows = $db->query($query)->fetchAll(PDO::FETCH_OBJ);

  if (count($rows)) {
   print '<table><tr><th>Название</th><th>Цена</th><th>Специи?</th></tr>';
   foreach ($rows as $row) {
     if ($row->is_spicy == 1) {
       $is_spicy = 'Да';
     } else {
       $is_spicy = 'Нет';
     }
     printf('<tr><td>%s</td><td>%.2f</td><td>%s</td></tr>', $row->dish_name, $row->price, $is_spicy);
   }
   print '</table>';
  } else {
   print '<h2>Нет записей в таблице</h2>';
  }
} catch (PDOException $e) {
  print $e->getMessage();
  exit();
}
