<?php

require_once 'phpseclib/phpseclib/phpseclib/Net/SSH2.php';

echo "this is delete";

$servername = "venues.ms.wits.ac.za";
$mysql_username = "venues_db_user";
$mysql_name = "masi";
$mysql_password = "venues!@#";
$server_username = "matt";
$server_password = "venues_matt";


$ssh->login($server_username, $server_password) or die('Nope');

?>
