<?php
/**
 * Created by PhpStorm.
 * User: singi
 * Date: 2018/09/26
 * Time: 7:33 PM
 */

/**
 * @coversDefaultClass \MS35\WitsSoftwareDesign\AttemptBlocker
 */
class AttemptBlockerTest extends PHPUnit_Framework_TestCase
{
    protected $result;
    public function setup(){
        $this->result = new \MS35\WitsSoftwareDesign\AttemptBlocker();
    }

    public function testConfirmIPAddress()
    {
        $this->assertEquals(0,$this->result->confirmIPAddress);
    }
}
