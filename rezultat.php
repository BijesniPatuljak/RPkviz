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
require_once __DIR__ . '/model/QuizService.class.php';?>

<?php
session_start();
$qz = new QuizService();
$id_qz=$_SESSION['id_kviza'];
$i=(int) 0;
$j=(int) 0;
$pitanja=$qz->getAllQuestionsByQuizId( $id_qz );

foreach($pitanja as $pitanje){
$j=$j+1;
if(isset($_POST[$pitanje->question_number]) && $_POST[$pitanje->question_number] == $pitanje->correct_answer_text) $i=$i+1;


}

echo 'Vaš rezultat je:' . $i . '/' . $j;

?>
<p><form action='menu.php'><input type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>

</body>
</html>