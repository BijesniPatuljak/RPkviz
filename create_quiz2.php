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
echo '<h2>' . $_POST["quiz_name"] . '</h2>';
?>


<?php
$qz=new QuizService();
$_SESSION["quiz_name"]=$_POST["quiz_name"];
$naslov_kviza= $_POST["quiz_name"];
if($qz->getQuizByTitle($_POST["quiz_name"])) echo "<p>Taj kviz već postoji</p>";

else{
$qz->makeQuiz($_POST["quiz_name"]);}

?>

<p><form action="create_question_multi.php"><input type = "submit" value="Dodaj pitanje s više odgovora!"></input></form></p>
<p><form action="create_question_text.php"><input type = "submit" value="Dodaj tekstualno pitanje!"></input></form></p>
<p><form action='menu.php'><input type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>

</body>
</html>