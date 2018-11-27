<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 23 Nov 2018
 * Time: 01:21
 */
include_once("LecturerFinder.php");

$finder = new LecturerFinder();
echo $finder->makeLecturersHTML();