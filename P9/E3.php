<?php
$source = './dishes.csv';
$fh = fopen($source, 'rb');
if (FALSE === $fh) {
  die("Невозможно открыть файл '{$source}': $php_errormsg");
}
$table = '<table><tr><th>Название</th><th>Цена</th><th>Специи?</th></tr>';
while ((! feof($fh)) && ($line = fgetcsv($fh))) {
  $spicy = $line[2] ? 'Да' : 'Нет';
  $table .= "<tr><td>$line[0]</td><td>$line[1]</td><td>$spicy</td></tr>";
}
$table .= '</table>';
if (! fclose($fh)) {
  die("Невозможно закрыть файл '{$source}': $php_errormsg");
}
print $table;
