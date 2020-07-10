<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script></head>
<body>
<?php
require_once __DIR__ . '/database/db.class.php';
require_once __DIR__ . '/model/ponudjeni_odgovor.class.php';
require_once __DIR__ . '/model/question.class.php';
require_once __DIR__ . '/model/quiz.class.php';
require_once __DIR__ . '/model/result.class.php';
require_once __DIR__ . '/model/user.class.php';
require_once __DIR__ . '/model/QuizService.class.php';

?>

<p><form action='create_quiz2.php' method = "post">Unesi ime kviza: <input type="text" name="quiz_name" method="post"></p>

<p><input type = "submit" value="Kreiraj kviz!"></input></p></form>

<p><form action="menu.php"><input type = "submit" value="Vrati se na meni!" action="menu.php"></input></form>

</body>
</html>