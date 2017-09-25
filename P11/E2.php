<?php
$c = curl_init('http://php.net/releases/?json');
curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
$responce = curl_exec($c);
$info = curl_getinfo($c);
if (FALSE === $response) {
  print 'Ошибка #' . curl_errno($c) . ': ' . curl_error($c);
} elseif ($info['http_code'] >= 400) {
  print 'Сервер ответил http-ошибкой: ' . $info['http_code'];
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
