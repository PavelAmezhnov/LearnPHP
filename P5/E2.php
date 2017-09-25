<?php
function image(string $filename, string $alt = '', int $width = 100, int $height = 100)
{
  $src = $GLOBALS['url'] . $filename;
  return "<img src=\"$src\" width=\"$width\" height=\"$height\" alt=\"$alt\"/>";
}

$url = 'http://yandex.ru/';

print image('xxx.jpeg');
