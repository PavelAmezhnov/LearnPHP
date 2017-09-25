<?php
  function process_form($array) {
    print '<ul>';
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        print '<li>' . "{$k}: " . '</li>';
        process_form($v);
      } else {
        print "<li>$k = $v</li>";
      }
    }
    print '</ul>';
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
