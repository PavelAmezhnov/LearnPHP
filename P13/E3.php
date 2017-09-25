<?php
namespace PHPUnit\Framework;
require_once 'vendor/phpunit/phpunit/src/Framework/TestCase.php';
require_once 'FormHelper.php';

class TestFormHelper extends TestCase
{
  public function testSelectWithAssocArray()
  {
    $options = ['first' => 'Первый', 'second' => 'Второй', 'third' => 'Третий'];
    $attributes = ['name' => 'number'];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number">' .
      '<option value="first">Первый</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithNumArray()
  {
    $options = ['Первый', 'Второй', 'Третий'];
    $attributes = ['name' => 'number'];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number">' .
      '<option value="0">Первый</option>' .
      '<option value="1">Второй</option>' .
      '<option value="2">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithoutAttributes()
  {
    $options = ['first' => 'Первый', 'second' => 'Второй', 'third' => 'Третий'];

    $form = new FormHelper;
    $select = $form->select($options);
    $expected_string = '<select>' .
      '<option value="first">Первый</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithBooleanAttributesTrue()
  {
    $options = ['first' => 'Первый', 'second' => 'Второй', 'third' => 'Третий'];
    $attributes = ['name' => 'number', 'multiple' => true];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number[]" multiple>' .
      '<option value="first">Первый</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithBooleanAttributesFalse()
  {
    $options = ['first' => 'Первый', 'second' => 'Второй', 'third' => 'Третий'];
    $attributes = ['name' => 'number', 'multiple' => false];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number">' .
      '<option value="first">Первый</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithRandomAttribute()
  {
    $options = ['first' => 'Первый', 'second' => 'Второй', 'third' => 'Третий'];
    $attributes = ['name' => 'number', 'random' => 'hello123'];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number" random="hello123">' .
      '<option value="first">Первый</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithAttributeMultiple()
  {
    $options = ['first' => 'Первый', 'second' => 'Второй', 'third' => 'Третий'];
    $attributes = ['name' => 'number', 'multiple' => 'true'];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number[]" multiple="true">' .
      '<option value="first">Первый</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }

  public function testSelectWithSpecSymbols()
  {
    $options = ['first' => '<Первый>', 'second' => 'Второй', 'third' => 'Третий'];
    $attributes = ['name' => 'number'];

    $form = new FormHelper;
    $select = $form->select($options, $attributes);
    $expected_string = '<select name="number">' .
      '<option value="first">&lt;Первый&gt;</option>' .
      '<option value="second">Второй</option>' .
      '<option value="third">Третий</option>' .
      '</select>';
    $this->assertEquals($expected_string, $select);
  }
}
