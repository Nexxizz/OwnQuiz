<?php
require_once 'Page.php';

class Process extends Page
{

    protected function processReceivedData(){
        session_start();
        //Check zo see if score is set
//        if(!isset($_SESSION['score'])){
//            $_SESSION['score'] = 0;
//        }

        $number = $_SESSION['number'];
        $next = $_SESSION["number"] + 1;

        if(isset(array_keys($_POST)[0]) && isset($_SESSION["richtigeAntwort"])) {
            if(array_keys($_POST)[0] == $_SESSION["richtigeAntwort"]) {
                if(isset($_SESSION["punkte"])) {
                    $_SESSION["punkte"] = (int)$_SESSION["punkte"] + 1;
                }
                else {
                    $_SESSION["punkte"] = 0;
                }
            }
        }

        if($number == $_SESSION['total']){
            header("Location: FinalPage.php");
            exit();
        } else {
            header("Location: Question.php?n=".$next);
            exit();
        }
    }

    public static function main()
    {
        try {
            $page = new Process();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain");
            echo $e->getMessage();
        }
    }
}
Process::main();
?>
