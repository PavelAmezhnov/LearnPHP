<?php
$url = 'http://php.net/releases/?json';
$responce = file_get_contents($url);
if (FALSE === $response) {
  print 'Ошибка выполнения запроса';
} else {
  $versions = json_decode($responce, TRUE);
  $num_ver = array_keys($versions);
  rsort($num_ver);
  $new_ver = $versions[$num_ver[0]];
  if (array_key_exists('version', $new_ver)) {
    print 'Последняя версия PHP - ' . $new_ver['version'];
  } else {
    print 'Запись о версии не найдена';
  }
}
