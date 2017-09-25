<?php
$form =
<<<_HTML_
<form method="POST" action="{$_SERVER['PHP_SELF']}">
  <div>
    <span>Укажите имя файла в корневом каталоге</span>
  </div>
  <div>
    <input type="text" name="path" value="">
  </div>
  <div>
    <button type="submit" name="submit" value ="submit">Показать</button>
</form>
_HTML_;

print $form;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $input_path = realpath($_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['path']);
  if (FALSE === $input_path) {
    $error = '<p>Файл не существует</p>';
  } else {
    $input_path = str_replace('\\', '/', $input_path);
    $doc_root_len = strlen($_SERVER['DOCUMENT_ROOT']);
    if (substr($input_path, 0, $doc_root_len) == $_SERVER['DOCUMENT_ROOT']) {
      if (is_readable($input_path)) {
        if (strcasecmp(substr($input_path, -5), '.html') == 0) {
          $file = htmlentities(file_get_contents($input_path));
          file_put_contents('php://output', '<p>' . $file . '</p>');
        } else {
          $error = '<p>Разрешено чтение только HTML-файлов</p>';
        }
      } else {
        $error = '<p>Файл недоступен для чтения</p>';
      }
    } else {
      $error = '<p>Доступ запрещен</p>';
    }
  }
}

print $error;
