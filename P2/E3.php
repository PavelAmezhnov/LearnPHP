<?php
$hamburger = 4.95;
$cocktail = 1.95;
$coca_cola = 0.85;
$rate_1 = 0.075;
$rate_2 = 0.16;

$total = 2 * $hamburger + $cocktail + $coca_cola;
$total_tax = (1 + $rate_1 + $rate_2) * $total;

printf("%-12s 2 x %.2f\n", 'Hamburger', $hamburger);
printf("%-12s 1 x %.2f\n", 'Cocktail', $cocktail);
printf("%-12s 1 x %.2f\n", 'Coca-cola', $coca_cola);
printf("%-15s %.2f\n", 'Total', $total);
printf("%-15s %.2f", 'Total w. tax', $total_tax);
