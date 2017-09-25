<?php
  $report = '';
  $html = '';

  $fields = [
    'sender' => ['Адрес отправителя', 'string'],
    'recipient' => ['Адрес получателя', 'string'],
    'length' => ['Длина', 'float', 91],
    'height' => ['Высота', 'float', 91],
    'depth' => ['Глубина', 'float', 91],
    'weight' => ['Вес посылки', 'float', 68]
  ];

  $input = array();
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $k => $v) {
      $input[$k] = htmlentities(trim($v));

      if ($input[$k] === '') {
        $errors[$k] = 'Поле "' . $fields[$k][0] . '" не должно быть пустым';
      }

      if ($input[$k] !== '' && $fields[$k][1] === 'float') {
        $error = validate_float($input[$k], $fields[$k]);
        if ($error !== '') {
          $errors[$k] = $error;
          $input[$k] = '';
        }
      }
    }

    if (! empty($errors)) {
      $html .= '<ul>';
      foreach ($errors as $error) {
        $html .= "<li>$error</li>";
      }
      $html .= '</ul>';
    } else {

      $report =
<<<_REPORT_
  <h2>Отчет</h2>
  <p>Отправитель - %s</p>
  <p>Получатель - %s</p>
  <p>Габариты посылки (ДхВхГ) см<sup>3</sup> - %.1fх%.1fх%.1f</p>
  <p>Вес посылки, кг - %.2f</p>
_REPORT_;
    }
  }

  function validate_float($input, $field) {
    if (filter_var($input, FILTER_VALIDATE_FLOAT)) {
      if ($input <= 0) {
        return 'Значение "' . $field[0] . '" не должно быть меньше нуля';
      } elseif ($input > $field[2]) {
        return 'Значение "' . $field[0] . '" не должно быть более ' . $field[2];
      } else {
        return '';
      }
    } else {
      return 'Значение должно быть числом';
    }
  }

  $html .=
<<<_HTML_
  <form method="POST" action="$_SERVER[PHP_SELF]">
    <p>
      <span>Адрес отправителя </span>
      <span><input type="text" name="sender" value="$input[sender]"></span>
    </p>
    <p>
      <span>Адрес получателя </span>
      <span><input type="text" name="recipient" value="$input[recipient]"></span>
    </p>
    <p>
      <span>Габариты*</span>
      <table>
        <tr>
          <th>Длина</th>
          <th>Высота</th>
          <th>Глубина</th>
        </tr>
        <tr>
          <td><input type="text" name="length" value="$input[length]"></td>
          <td><input type="text" name="height" value="$input[height]"></td>
          <td><input type="text" name="depth" value="$input[depth]"></td>
        </tr>
      </table>
      <span>*Не должны превышать 91х91х91 см<sup>3</sup></span>
    </p>
    <p>
      <div>
        <span>Вес посылки* </span>
        <span><input type="text" name="weight" value="$input[weight]"></span>
      </div>
      <div>
        <span>*Не более 68 кг</span>
      </div>
    </p>
    <p>
      <button type="submit">Отправить</button>
    </p>
  </form>
_HTML_;

vprintf($report, $input);
print $html;
