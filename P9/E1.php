<?php
$source = './template.html';
$html = file_get_contents($source);
if ($html !== FALSE) {
  $html = str_replace('{title}', 'Хелоуворлдщик', $html);
  $html = str_replace('{color}', '#00FF33', $html);
  $html = str_replace('{name}', 'World', $html);
  $target = './index.html';
  if (! file_exists($target)) {
    $new_file = file_put_contents($target, $html);
    if (FALSE === $new_file) {
      print 'Невозможна запись в ' . $new_file . ' : ' . $php_errosmsg;
    }
  } else {
    print 'Файл ' . $new_file . ' уже существует';
  }
} else {
  print 'Невозможно прочитать файл ' . $source . ' : ' . $php_errosmsg;
}
