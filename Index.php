<?php
require_once 'Page.php';

class Index extends Page
{
    protected function generateView(){
        $this->generatePageHeader("Quizmeister");
        echo <<< EOT
        <h1>Wer wird Quizmeister</h1>
        <p>Testen Sie Ihr Wissen</p>
        <a href="Question.php">Zu den Fragen</a>
EOT;


    }

    public static function main()
    {
        try {
            $page = new Index();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain");
            echo $e->getMessage();
        }
    }
}
Index::main();
?>
