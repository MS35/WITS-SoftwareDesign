<?php
    //include 'AttemptBlocker.php';
    class ip
    {
        function getRealIPAddr()//this gets the ip of the person using the html file
        {
            //check ip from share internet

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } //to check ip is pass from proxy

            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
    }
?>