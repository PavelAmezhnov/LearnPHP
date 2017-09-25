<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=LearnPHP', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $query = 'SELECT `id`, `dish_name` FROM `dishes`';
  $dishes = $db->query($query)->fetchAll();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $k => $v) {
      $input[$k] = trim(htmlentities($v));
      if (! strlen($input[$k])) {
        $errors[$k] = 'Заполните поле';
      }
    }

    if (strlen($input['name']) > 255) {
      $errors['name'] = 'Не более 255 символов';
      $input['name'] = '';
    }

    if (filter_var($input['phone'], FILTER_VALIDATE_INT)) {
      if ($len_phone = strlen($input['phone']) < 10) {
        $errors['phone'] = 'Слишком короткий номер';
        $input['phone'] = '';
      } elseif ($len_phone > 11) {
        $errors['phone'] = 'Слишком длинный номер';
        $input['phone'] = '';
      }
    } else {
      $errors['phone'] = 'Введите корректный номер телефона';
      $input['phone'] = '';
    }

    if ($input['dish']) {
      foreach ($dishes as $dish) {
        if ($input['dish'] == $dish['dish_name']) {
          $id_fav_dish = $dish['id'];
          break;
        }
      }
      if (NULL === $id_fav_dish) {
        $id_fav_dish = 0;
      }
    } else {
      $errors['dish'] = 'Выберите одно из блюд';
    }

    if (NULL === $errors) {
      $query  = 'INSERT INTO `visitors` (`name`, `phone`, `id_fav_dish`) VALUES (?, ?, ?)';
      $stmt = $db->prepare($query);
      $stmt->execute(array($input['name'], $input['phone'], $id_fav_dish));
      $new_user = '<h3>Добавлен пользователь</h3>';
    }
  }
} catch (PDOException $e) {
  print $e->getMessage();
  exit();
}

$html =
<<<_FORM_
<form method="POST" action="{$_SERVER['PHP_SELF']}">
  <div>
    <span>Ваше имя: </span>
    <input type="text" name="name" value="{$input['name']}">
    <span>{$errors['name']}</span>
  </div>
  <div>
    <span>Номер Вашего телефона: +</span>
    <input type="text" name="phone" value="{$input['phone']}">
    <span>{$errors['phone']}</span>
  </div>
  <div>
    <span>Выберите любимое блюдо: </span>
    <select name="dish" value="{$input['dish']}">
_FORM_;

if ($dishes) {
  foreach ($dishes as $dish) {
    $html .= '<option>' . $dish['dish_name'] . '</option>';
  }
}

$html .=
<<<_FORM_
    </select>
  </div>
  <div>
    <button type="submit" name="submit" value="submit">Отправить</button>
  </div>
</form>
_FORM_;

$html .= $new_user;

print $html;
