<?php
setcookie('date', time());
if (isset($_COOKIE['date'])) {
  print 'Прошлый раз Вы посещали эту страницу: ' . date('d-m-y h:m:s', $_COOKIE['date']);
} else {
  print 'Вы тут впервые';
}
