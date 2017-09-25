<?php
$form_data = [
  'description' => 'Bla-bla',
  'public' => FALSE,
  'files' => [
    'example-l-1-l-1-l-1.php' => [
      'content' => '<?php print time();'
    ]
  ]
];
$c = curl_init('https://api.github.com/gists');
curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($c, CURLOPT_USERAGENT, 'l-1-l-1-l-1');
curl_setopt($c, CURLOPT_POST, TRUE);
curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($form_data));
$response = curl_exec($c);
$info = curl_getinfo($c);
if (FALSE === $response) {
  print 'Запрос неудачен';
} elseif ($info['http_code'] >= 400) {
  print 'Сервер ответил http-ошибкой: ' . $info['http_code'];
} else{
  $html = json_decode($response);
  print $html->url;
}
