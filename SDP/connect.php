<?php
    class connect
    {
        function connectDetail()
        {
            $username = "venues_db_user";
            $password = "venues!@#";
            $database = "venue_allocations_db";
            $link = mysqli_connect("127.0.0.1", $username, $password, $database);
            return $link;
        }
        function closeConnection(){
            mysqli_close($this->connectDetail());
        }
    }