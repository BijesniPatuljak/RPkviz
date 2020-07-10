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
?>

<?php
$qz = new QuizService();
if(isset($_SESSION['user_name'])){$us=$_SESSION['user_name'];}
else {$us=$_POST['user_name'];
$_SESSION['user_name']=$us;}
if(!($qz->getUserByUsername($us))){
	$qz->makeUser($us);
}



?>




<?php
$qz = new QuizService();

$svi_kvizovi = $qz->getAllQuizzes();

$i = 0;

?>

<form method="post" action= "load_quiz.php">
<p>Izaberi kviz: <select name="id_kviza" method="post">


<?php

foreach ($svi_kvizovi as $naslov){
 
echo '<option value=' . $naslov->id . '>' . $naslov->title . '</option>';}
?>
</select></p>
<p><input type = "submit" value="Pokreni kviz!" ></input></form></p>

<?php
if($us == "admin"){
echo '<p> Ili';
echo '<p><form action="create_quiz1.php"><input type = "submit" value="Napravi novi!"></input></form>';}
?>

</form>
</body>
</html>