<?php
namespace PHPUnit\Framework;
require_once 'vendor/phpunit/phpunit/src/Framework/TestCase.php';

class SimpleClass extends TestCase
{
  public function testWow()
  {
    $this->assertEquals('abc', 'a' . 'b' . ' c');
  }
}
