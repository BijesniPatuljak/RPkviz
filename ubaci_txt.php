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
if(isset($_POST['pitanje']) && isset($_POST['odgovor'])){
$kz = $qz->getQuizByTitle($_SESSION["quiz_name"]);
$kid = $kz->id;
$pitanja= $qz->getAllQuestionsByQuizId( $kid );
$brpitanja= (int)count($pitanja)+1;
$qz->makeQuestion(5, $brpitanja, 'text', $_POST['pitanje'], $_POST['odgovor']);}
else{echo "Nije uneseno pitanje i/ili dogovor!";}

?>

<p><form action='menu.php'><input type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>
</body>
</html>