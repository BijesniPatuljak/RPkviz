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

echo 'Unesi tekst pitanja:<form action="ubaci_txt.php" method="post"><input type="text" name="pitanje" ></input><br>';
echo 'Unesi tekst odgovora:<input type="text" name="odgovor" ></input><br>';

?>

<p><input type = "submit" value="Dodaj pitanje!"></input></form></p>
<p><form action='menu.php'><input type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>

</body>
</html>