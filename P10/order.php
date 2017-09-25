<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  unset($_SESSION['order']);
}

$order =
<<<_HTML_
<!DOCTYPE html>
<html>
  <head>
    <title>Ваш заказ</title>
  </head>
  <body>
_HTML_;

if (isset($_SESSION['order'])) {
  $order .=
<<<_HTML_
  <h3>Вы заказали</h3>
  <table>
    <tr><th>Название блюда</th><th>Количество</th></tr>
_HTML_;
  foreach ($_SESSION['order'] as $dish => $count) {
      $order .= "<tr><td>$dish</td><td>$count</td></tr>";
  }
  $order .= '</table>';
} else {
  $order .= '<h2>Заказа нет</h2>';
}

$order .=
<<<_HTML_
    <p><a href="./E4.php">К форме заказа</a><p>
    <form method="POST" action="{$_SERVER['PHP_SELF']}">
      <button type="submit" name="submit" value="submit">Оформить заказ</button>
    </form>
  </body>
</html>
_HTML_;

print $order;
