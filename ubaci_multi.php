<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body>

<?php
require_once __DIR__ . '/database/db.class.php';
require_once __DIR__ . '/model/ponudjeni_odgovor.class.php';
require_once __DIR__ . '/model/question.class.php';
require_once __DIR__ . '/model/quiz.class.php';
require_once __DIR__ . '/model/result.class.php';
require_once __DIR__ . '/model/user.class.php';
require_once __DIR__ . '/model/QuizService.class.php';

session_start();
echo '<h2>' . $_SESSION["quiz_name"] . '</h2>';
?>


<?php
$qz=new QuizService();
if(isset($_POST['pitanje']) && isset($_POST['odgovor1']) && isset($_POST['odgovor2'])){
$kz = $qz->getQuizByTitle($_SESSION["quiz_name"]);
$kid = $kz->id;
$pitanja= $qz->getAllQuestionsByQuizId( $kid );
$brpitanja= (int)count($pitanja)+1;
$todgovor = "odgovor" . $_POST['numera'];
$qz->makeQuestion(5, $brpitanja, 'checkbox', $_POST['pitanje'], $_POST[$todgovor]);}
foreach($pitanja as $pitanje){$qid = $pitanje->id;};
$qz->makePonudjeniOdgovor($qid, 1, $_POST['odgovor1']);
$qz->makePonudjeniOdgovor($qid, 2, $_POST['odgovor2']);
if(isset($_POST['odgovor3'])) $qz->makePonudjeniOdgovor($qid, 3, $_POST['odgovor3']);
if(isset($_POST['odgovor4'])) $qz->makePonudjeniOdgovor($qid, 4, $_POST['odgovor4']);
else{echo "Nije uneseno pitanje i/ili dovoljno dogovora (barem dva)!";}

?>

<p><form action='menu.php'><input type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>
</body>
</html>