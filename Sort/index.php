<?php

require_once 'classes/Controller/MainController.php';
list($ar, $before, $after, $time) = MainController::execute();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Сортировки</title>
    </head>
    <body>
        <div>
            <form method="POST">
                <div>
                    <span>Сортировка: </span>
                    <select name="sort_name">
                        <option value=""></option>
                        <option value="bubble_sort">Пузырьком</option>
                        <option value="insertion_sort">Вставками</option>
                        <option value="selection sort">Выбором</option>
                        <option value="quick_sort">Быстрая</option>
                        <option value="shell_sort">Шелла</option>
                        <option value="merge_sort">Слиянием</option>
                        <option value="heap_sort">Кучей</option>
                        <option value="j_sort">JSort</option>
                    </select>
                    <button type="submit" name="new_array" value="new_array">Новый массив</button>
                    <button type="submit" name="sort_array" value="sort_array">Сортировать</button>
                    <input type="hidden" name="array" value="<?=$ar;?>" />
                </div>
            </form>
        </div>
        <div>
            <p>До сортировки: <?=$before;?></p>
            <p>После сортировки: <?=$after;?></p>
            <p>Затраченное время: <?=$time;?></p>
        </div>
    </body>
</html>