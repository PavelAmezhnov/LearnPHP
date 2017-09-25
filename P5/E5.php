<?php
function rgb(int $r, int $g, int $b)
{
  $rgb = [$r, $g, $b];
  $result = '#';
  for ($i = 0, $count = count($rgb); $i < $count; $i++) {
    if ($rgb[$i] < 16) {
      $result .= '0' . dechex($rgb[$i]);
    } else {
      $result .= dechex($rgb[$i]);
    }
  }
  return $result;
}

print rgb(115, 115, 115);
