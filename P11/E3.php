<?php
$c = curl_init('http://LearnPHP/P11/cookie-script.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($c, CURLOPT_COOKIEJAR, __DIR__ . '/time.cookie');
curl_setopt($c, CURLOPT_COOKIEFILE, __DIR__ . '/time.cookie');
$time = curl_exec($c);
$info = curl_getinfo($c);
if (FALSE === $time) {
  print 'Ошибка #' . curl_errno($c) . ': ' . curl_error($c);
} elseif ($info['http_code'] >= 400) {
  print 'Сервер ответил http-ошибкой: ' . $info['http_code'];
} else {
  print $time;
}
