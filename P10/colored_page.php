<?php
session_start();

$html = <<<_HTML_
<!DOCTYPE html>
<html>
  <head>
    <title>Colored page</title>
  </head>
  <body bgcolor="#{$_SESSION['bg_color']}">
  </body>
</html>
_HTML_;

print $html;
