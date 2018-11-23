<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 24 Sep 2018
 * Time: 21:14
 */

class DBConnector
{
    private $host;
    private $username;
    private $password;
    private $connection;

    public function __construct()
    {
        $this->host = "127.0.0.1";
        $this->username = "venues_db_user";
        $this->password = "venues!@#";
        $this->connection = null;
    }

    /**
     * @return bool
     */
    public function createConnection(){
        $this->connection = mysqli_connect($this->host,$this->username,$this->password);

        if($this->connection->connect_error){
            return false;
        }else{
            return true;
        }
    }

    public function getConnection(){
        return $this->connection;
    }

    public function closeConnection(){
        return mysqli_close($this->connection);
    }
}