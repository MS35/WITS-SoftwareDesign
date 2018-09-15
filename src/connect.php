<?php
    class connect
    {
        function connectDetail()
        {
            $username = "s1312548";
            $password = "s1312548";
            $database = "d1312548";
            $link = mysqli_connect("127.0.0.1", $username, $password, $database);
            return $link;
        }
        function closeConnection(){
            mysqli_close($this->connectDetail());
        }
    }
?>
