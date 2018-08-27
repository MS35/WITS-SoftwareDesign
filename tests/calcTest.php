<?php
/**
 * Created by PhpStorm.
 * User: singi
 * Date: 2018/08/27
 * Time: 9:18 PM
 */

namespace Projects\Maths;


class calcTest extends \PHPUnit_Framework_TestCase
{

    private $calc;
    public function __construct()
    {
        $this->calc = new calc();
        parent::__construct();
    }
    public function testInstanceCalculator()
    {
        $this->assertInstanceOf(calc::class, $this->calc);
    }

    public function testAdd()
    {
        $value = $this->calc->add(2, 3);
        $this->assertEquals($value, 5);
    }

}
