<?php

include_once "ApplicationViewer.php";

$viewer = new ApplicationViewer();
$user_id = "123456";
$user_id = "LECTURER";

echo $viewer->findApplicationsUser($user_id);
