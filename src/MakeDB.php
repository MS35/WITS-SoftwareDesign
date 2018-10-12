<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 27 Sep 2018
 * Time: 21:08
 */

include "DBCreator.php";

$dbm = new DBCreator();

$dbm->createDB();

echo "done";