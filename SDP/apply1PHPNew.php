<?php
    class apply1PHPNew
    {

        public function nextButton()
        {
            session_start();
            $courseCode = $_POST['course'];
            $class = $_POST['class'];

            if($class == "addNew"){
                $_SESSION["course_code"] = $courseCode;
                header("Location: addClass.html");
            }else{
                $_SESSION["courCo"] = $courseCode;
                $_SESSION["classApp1"] = $class;
                header("Location: form.html");
            }

            exit();
        }
        public function backButton()
        {
            header("Location:../MenuNew/index.html");
            exit();
        }
        public function remain(){
            header("Location:../MenuNew/pickClass.html");
            exit();
        }
    }
    if (!empty($_POST['next']) and !empty($_POST['course']) and !empty($_POST['class'])){
        $next = new apply1PHPNew();
        $next->nextButton();
    }
    else{
        $remain1 = new apply1PHPNew();
        $remain1->remain();
    }
    if (isset($_POST['back'])) {
        $back = new apply1PHPNew();
        $back->backButton();
    }
    else{
        $remain1 = new apply1PHPNew();
        $remain1->remain();
    }