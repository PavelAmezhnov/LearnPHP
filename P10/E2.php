<?php
if (isset($_COOKIE['num_views']) && $_COOKIE['num_views'] !== 0) {
  $num_views = $_COOKIE['num_views'] + 1;
} else {
  $num_views = 1;
}

if ($num_views === 20) {
  setcookie('num_views', $num_views, time() - 1);
} else {
  setcookie('num_views', $num_views);
}

if ($num_views % 5) {
  print "Количество просмотров: $num_views";
} else {
  print "ВАУ! Количество просмотров: $num_views";
}
