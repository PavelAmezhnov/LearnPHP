<?php
namespace PHPUnit\Framework;
require_once 'vendor/phpunit/phpunit/src/Framework/TestCase.php';
require_once 'FormHelper.php';

class TestFormHelper extends TestCase
{
  public function testButtonTag()
  {
    $attributes = ['type' => 'submit', 'value' => 'Отправить'];

    $form = new FormHelper;
    $button = $form->button($attributes);
    $expected_string = '<button type="submit" value="Отправить" />';
    $this->assertEquals($expected_string, $button);
  }
}
