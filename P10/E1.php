<?php
if (isset($_COOKIE['num_views']) && $_COOKIE['num_views'] !== 0) {
  $num_views = $_COOKIE['num_views'] + 1;
} else {
  $num_views = 1;
}
setcookie('num_views', $num_views);

print "Количество просмотров: $num_views";
