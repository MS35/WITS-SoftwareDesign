<?php

$course_code = $_POST['course'];

include_once("ClassFinder.php");

$finder = new ClassFinder();

echo $finder->makeClassesHTML($course_code);