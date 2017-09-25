<?php
function image(string $src, string $alt = '', int $width = 100, int $height = 100)
{
  return "<img src=\"$src\" width=\"$width\" height=\"$height\" alt=\"$alt\"/>";
}

print image('http://yandex.ru/xxx.jpeg', 'clickme');
