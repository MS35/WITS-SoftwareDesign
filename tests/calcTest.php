<?php
/**
 * Created by PhpStorm.
 * User: singi
 * Date: 2018/08/28
 * Time: 9:22 AM
 */

include("calc.php");

class calcTest extends \PHPUnit_Framework_TestCase
{
    public function testWord()
    {
        $calcc = new calc();
        /** @var TYPE_NAME $calcc */
        assertContains($calcc,"dude");
    }
}
?>
