<?php
  $input = [];
  $errors = [];
  $operations = ['add' => '+', 'sub' => '-', 'mult' => '*', 'div' => '/'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $k => $v) {
      error_log("[$k: $v]");
    }
    // error_log("[operand_1: {$_POST['operand_1']}]");
    // error_log("[operation: {$_POST['operation']}]");
    // error_log("[operand_2: {$_POST['operand_2']}]");
    $operation = trim(htmlentities($_POST['operation']));

    $input['operand_1'] = trim(htmlentities($_POST['operand_1']));
    if (FALSE === filter_var($input['operand_1'], FILTER_VALIDATE_FLOAT)) {
      $input['operand_1'] = '';
      $errors['operand_1'] = 'Введите корректное 1е число';
    }

    $input['operand_2'] = trim(htmlentities($_POST['operand_2']));
    if (FALSE === filter_var($input['operand_2'], FILTER_VALIDATE_FLOAT)) {
      $input['operand_2'] = '';
      $errors['operand_2'] = 'Введите корректное 2е число';
    } elseif ($input['operand_2'] === '0' && $operation == 'div') {
      $input['operand_2'] = '';
      $errors['operand_2'] = 'Делить на нуль нельзя';
    }

    if (array_key_exists($operation, $operations)) {
      if (empty($errors)) {
        if ($operation === 'add') {
          $result = $input['operand_1'] + $input['operand_2'];
        } elseif ($operation === 'sub') {
          $result = $input['operand_1'] - $input['operand_2'];
        } elseif ($operation === 'mult') {
          $result = $input['operand_1'] * $input['operand_2'];
        } else {
          $result = $input['operand_1'] / $input['operand_2'];
        }
        $output = $input['operand_1'] . ' ' . $operations[$operation] . ' ' . $input['operand_2'] . ' = ' . $result;
      }
    } else {
      $errors['operation'] = 'Некорректная операция';
    }
  }

foreach ($errors as $error) {
  print "$error<br>";
}

print
<<<_HTML_
<form method="POST" action="{$_SERVER['PHP_SELF']}">
  <table>
    <tr>
      <th>Операнд 1</td>
      <th>Операция</td>
      <th>Операнд 2</td>
    </tr>
    <tr>
      <td><input type="text" name="operand_1" value ="{$input['operand_1']}"></td>
      <td>
        <select name="operation">
          <option value="add" selected>+</option>
          <option value="sub">-</option>
          <option value="mult">*</option>
          <option value="div">/</option>
        </select>
      </td>
      <td><input type="text" name="operand_2" value ="{$input['operand_2']}"></td>
      <td><button type="submit" name="submit" value="submit">Вычислить</button></td>
    </tr>
  </table>
</form>
<p>$output<p>
_HTML_;
