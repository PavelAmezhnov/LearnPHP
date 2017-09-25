<?php
$source = './addresses.txt';
$addresses = file($source);
if (FALSE === $addresses) {
  die("Невозможно прочитать файл '{$source}': $php_errormsg");
}
$count_adr = array();
foreach ($addresses as $address) {
  $address = trim($address);
  if (array_key_exists($address, $count_adr)) {
    $count_adr[$address] = $count_adr[$address] + 1;
  } else {
    $count_adr[$address] = 1;
  }
}
arsort($count_adr);
$target = './counted_addresses.txt';
$fh = fopen($target, 'ab');
if (FALSE !== $fh) {
  foreach ($count_adr as $address => $count) {
    fwrite($fh, "{$count}, $address  \n");
  }
  if (! fclose($fh)) {
    die("Невозможно закрыть файл '{$target}': $php_errormsg");
  }
} else {
  die("Невозможно открыть для записи файл '{$target}': $php_errormsg");
}
