<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 11 Oct 2018
 * Time: 02:58
 */

class DeadlineSetter
{
    private $time;
    private $date;
    private $setter_id;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getSetterId()
    {
        return $this->setter_id;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;

        if($dlFile = fopen("deadline.txt",'w')){
            $dataArr = array($this->date,$this->time,$this->setter_id);
            $data = implode("#",$dataArr);
            fwrite($dlFile,$data);
            fclose($dlFile);
        }else{
            echo "File Create/Write failed\n";
        }
    }

    /**
     * @param mixed $setter_id
     */
    public function assignSetterId($setter_id)
    {
        $this->setter_id = $setter_id;

        if($dlFile = fopen("deadline.txt",'w')){
            $dataArr = array($this->date,$this->time,$this->setter_id);
            $data = implode("#",$dataArr);
            fwrite($dlFile,$data);
            fclose($dlFile);
        }else{
            echo "File Create/Write failed\n";
        }
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;

        if($dlFile = fopen("deadline.txt",'w')){
            $dataArr = array($this->date,$this->time,$this->setter_id);
            $data = implode("#",$dataArr);
            fwrite($dlFile,$data);
            fclose($dlFile);
        }else{
            echo "File Create/Write failed\n";
        }
    }

    public function __construct()
    {
        if($dlFile = fopen("deadline.txt",'r')){
            $data = fread($dlFile,filesize("deadline.txt"));

            $dataArr = explode("#",$data);
            $this->date = $dataArr[0];
            $this->time = $dataArr[1];
            $this->setter_id = $dataArr[2];

            fclose($dlFile);
        }else{
            $this->date = '';
            $this->time = '';
            $this->setter_id = '';
        }
    }
}