<?php
/**
 * @coversDefaultClass \MS35\WitsSoftwareDesign\HelloWorld
 */
class HelloWorldTest extends \PHPUnit_Framework_TestCase{
  protected $hello;
  
  public function setUp(){//this part of the code initiates the hello variable
    $this->hello = new \MS35\WitsSoftwareDesign\HelloWorld();
  }
  /**
   * @covers ::world
   */
  public function testHelloWorld(){//this part of the code checks if the value returned by the world() method is equal to word
    $this->assertSame('world',$this->hello->world());
  }
}
