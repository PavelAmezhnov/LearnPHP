<?php
$cities = [
  'Нью-Йорк' => ['Штат' => '', 'Население' => 8175133],
  'Лос-Арджелес' => ['Штат' => 'Калифорния', 'Население' => 3792621],
  'Чикаго' => ['Штат' => 'Иллинойс', 'Население' => 2695598],
  'Хьюстон' => ['Штат' => 'Техас', 'Население' => 2100263],
  'Филадельфия' => ['Штат' => 'Пенсильвания', 'Население' =>1526006]
];

$total = 0;

foreach ($cities as $values) {
  $total += $values['Население'];
}

print '<table>';
print '<tr><th>Город</th><th>Штат</th><th>Население</th></tr>';
foreach ($cities as $city => $values) {
  print "<tr><td>$city</td><td>$values[Штат]</td><td>$values[Население]</td></tr>";
}
print "<tr><td>Общее население: $total</td></tr>";
print '</table>';

foreach ($cities as $city => $values) {
  ksort($values);
  $cities_p[$city] = $values;
}

asort($cities_p);

print '<table>';
print '<tr><th>Город</th><th>Штат</th><th>Население</th></tr>';
foreach ($cities_p as $city => $values) {
  print "<tr><td>$city</td><td>$values[Штат]</td><td>$values[Население]</td></tr>";
}
print "<tr><td>Общее население: $total</td></tr>";
print '</table>';

ksort($cities);

print '<table>';
print '<tr><th>Город</th><th>Штат</th><th>Население</th></tr>';
foreach ($cities as $city => $values) {
  print "<tr><td>$city</td><td>$values[Штат]</td><td>$values[Население]</td></tr>";
}
print "<tr><td>Общее население: $total</td></tr>";
print '</table>';
