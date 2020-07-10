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
echo 'Unesi tekst pitanja:<form action="ubaci_multi.php" method="post"><input type="text" name="pitanje" ></input><br>';
echo 'Unesi tekst prvog odgovora:<input type="text" name="odgovor1" ></input><br>';
echo 'Unesi tekst drugog odgovora:<input type="text" name="odgovor2" ></input><br>';
echo 'Unesi tekst trećeg odgovora:<input type="text" name="odgovor3" ></input><br>';
echo 'Unesi tekst četvrtog odgovora:<input type="text" name="odgovor4" ></input><br>';
echo 'Unesi broj točnog odgovora:<input type="text" name="numera" ></input><br>';

?>

<p><input type = "submit" value="Dodaj pitanje!"></input></form></p>
<p><form action='menu.php'><input type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>

</body>
</html>