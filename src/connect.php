<?php
    namespace MS35\WitsSoftwareDesign;
    class connect
    {
        function connectDetail()
        {
            $username = "s1312548";
            $password = "s1312548";
            $database = "d1312548";
            $link = mysqli_connect("lamp.ms.wits.ac.za", $username, $password, $database);
            return $link;
        }
        function closeConnection(){
            mysqli_close($this->connectDetail());
        }
    }
?>
