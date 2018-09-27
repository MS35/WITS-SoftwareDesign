<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 24 Sep 2018
 * Time: 21:35
 */
include "DBConnector.php";

class DBCreator
{
    private $db_name;
    private $connector;
    private $script;

    public function __construct(){
        $this->db_name = "venue_allocations_db";
        $this->connector = new DBConnector();

        $filename = "_venue_allocations_db.sql";
        $dbFile = fopen($filename,"r") or die("Files not found");
        $dbScript = fread($dbFile,filesize($filename));
        fclose($dbFile);

        $arr = explode("\n",$dbScript);
        $new_lines = array();

        echo count($arr);

        foreach ($arr as $line){
            if(strlen($line) > 0){
                array_push($new_lines,$line);
            }
        }


        $this->script = implode("",$new_lines);
        


    }

    public function createDB(){
        do{
            $isConnected = $this->connector->createConnection();
        }while(!$isConnected);

        $connection = $this->connector->getConnection();

        $success = mysqli_multi_query($connection,$this->script);

        do{
            $isConnClosed = $this->connector->closeConnection();
        }while(!$isConnClosed);

        return $success;
    }

}