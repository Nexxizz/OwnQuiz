<?php
require_once 'Page.php';

class Question extends Page
{
    protected $number = 1;
    protected $total = 0;

    protected function getViewData(){
        $sqlStatement = "";
        //Set question number


        if(isset($_GET['n'])) {
            $_SESSION["number"] = (int)$_GET['n'];
            $number = (int)$_GET['n'];
        } else {
            $_SESSION["number"] = 1;
            $number = 1;
        }

        $sqlStatement = "SELECT * FROM questions where id = $number";

        $record = $this->db->query($sqlStatement);
        if(!$record){
            throw new InvalidArgumentException("Data could not be loaded from Database. Error: ".$this->db->error);
        }
        $result = $record->fetch_assoc();
        $this->total = $record->num_rows;
        $record->free();
        return $result;
    }

    protected function generateView(){
        $data = $this->getViewData();
        $this->generatePageHeader("Quizmeister");
        echo "<h1>Wer wird Quizmeister</h1>";
        $_SESSION["richtigeAntwort"] = $data["richtig"];
        if (isset($_SESSION["spielerName"]) && $_SESSION["spielerName"] != "") {
            $saveName = htmlspecialchars($_SESSION["spielerName"]);
            echo <<< EOT
        <h3>Spieler: $saveName
        <h3>Zeit: </h3>
        <div id ="myProgress">
            <div id="myBar" data-percent="0"></div>
        </div>
EOT;
        if (isset($_SESSION["punkte"])) {
                    echo "<br>Punkte: " . $_SESSION["punkte"] . "</h3>";
                };
//        var_dump($data);
            echo "<p>Fragen Nummer: ".$data['id'].". Insgesamt Fragen: ";
            if(isset($_SESSION['total'])) {
                echo $_SESSION['total'];
            }
            else {
                echo "1";
            }
            echo "</p>";
        echo <<< EOT
            
        <form action="Process.php" method="post" name="antwort">
        
        <h2>Frage:</h2>
        <p>$data[frage]</p>
        <input type="submit" value="$data[antwort1]" name="1">
        <input type="submit" value="$data[antwort2]" name="2">
        <input type="submit" value="$data[antwort3]" name="3">
        <input type="submit" value="$data[antwort4]" name="4">
        </form>
        <form action="Question.php" method="post">
        <input type="submit" value="Neu Starten" name="neuStart">
        </form>
EOT;
            } else {
                echo <<< EOT
        <p>Neues Spiel - Bitte ihren Namen eingeben</p>
        <form action="Question.php" method="post">
        <input type="text" placeholder="Ihr Name" required name="spieler">
        <input type="submit" hidden>
        </form>
EOT;
            }

    }

    protected function processReceivedData()
    {
        session_start();

        parent::processReceivedData();
        $sqlStatementCount = "SELECT COUNT(*) AS size FROM questions";
        $recordCount = $this->db->query($sqlStatementCount);
        if(!$recordCount){
            throw new InvalidArgumentException("Data could not be loaded from Database. Error: ".$this->db->error);
        }
        $resultCount = $recordCount->fetch_assoc();
        $_SESSION['total'] = $resultCount["size"];
        $recordCount->free();

        if(isset($_POST["spieler"])){
            $_SESSION["spielerName"] = $_POST["spieler"];
        }
        if(isset($_POST["neuStart"])){
            session_destroy();
            header('Location: Index.php');
            exit();
        }

//        if(isset(array_keys($_POST)[0]) && isset($_SESSION["richtigeAntwort"])) {
//            if(array_keys($_POST)[0] == $_SESSION["richtigeAntwort"]) {
//                if(isset($_SESSION["punkte"])) {
//                    $_SESSION["punkte"] = (int)$_SESSION["punkte"] + 1;
//                }
//                else {
//                    $_SESSION["punkte"] = 1;
//                }
//            }
//        }

    }

    public static function main()
    {
        try {
            $page = new Question();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain");
            echo $e->getMessage();
        }
    }
}
Question::main();
?>
