<?php
/**
 * Created by PhpStorm.
 * User: singi
 * Date: 2018/09/14
 * Time: 6:13 PM
 */
/**
 * @coversDefaultClass \MS35\WitsSoftwareDesign\access
 */
class accessTest extends PHPUnit_Framework_TestCase
{
    protected $result;
    public function setUp(){
        $this->result = new \MS35\WitsSoftwareDesign\access();
    }
    /*
     * @covers ::accessBad
     */

    public function accessBad(){
        $this->assertSame('failed',$this->result->accessBad());
    }
}
