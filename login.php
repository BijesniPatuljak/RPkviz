<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body>

<?php
//require_once __DIR__ . '/init.php';
require_once __DIR__ . '/database/db.class.php';
require_once __DIR__ . '/model/ponudjeni_odgovor.class.php';
require_once __DIR__ . '/model/question.class.php';
require_once __DIR__ . '/model/quiz.class.php';
require_once __DIR__ . '/model/result.class.php';
require_once __DIR__ . '/model/user.class.php';
require_once __DIR__ . '/model/QuizService.class.php';

session_start();
?>


<h2>Dobrodošli u Quizmaster!</h2>

<form action="menu.php" method = "post">
<p>Upiši ime: <input type="text" name="user_name" ></p>

<p><input type = "submit" value=" Započni! "></input></p>



</form>
</body>
</html>
