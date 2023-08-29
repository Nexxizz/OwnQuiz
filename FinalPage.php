<?php
require_once 'Page.php';

class FinalPage extends Page
{
    protected function generateView(){
        $this->generatePageHeader("Quizmeister");
        echo "<h1>Wer wird Quizmeister</h1>";
        if (isset($_SESSION["spielerName"]) && $_SESSION["spielerName"] != "") {
            $saveName = htmlspecialchars($_SESSION["spielerName"]);
            echo <<< EOT
        <h3>Spieler: $saveName </h3>
EOT;
            if (isset($_SESSION["punkte"])) {
                echo "<h3>Punkte: " . $_SESSION["punkte"] . "</h3>";
            }
        } else {
            echo "<h3>Punkte: 0 </h3>";
            echo "<a href='Index.php'>Neues Spiel</a>";
        }
    }

    public static function main()
    {
        try {
            $page = new FinalPage();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain");
            echo $e->getMessage();
        }
    }
}
FinalPage::main();
?>
