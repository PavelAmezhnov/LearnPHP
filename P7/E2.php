<?php
  function process_form($array, $key = '') {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        $string = $key . '[' . $k . ']';
        process_form($v, $string);
      } else {
        print $key . '[' . $k . ']'  . ' = ' . $v . '<br>';
      }
    }
  }

  $array1 = [
    'a' => '1',
    'b' => 'ad',
    'c' => 'qq1',
    'd' => '86',
    'e' => [
      'a' => 'abc',
      'b' => ['a' => 'defg', 'b' => 'zaq']
      ]
    ];

  process_form($array1);
