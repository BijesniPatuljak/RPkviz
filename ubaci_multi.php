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
<div class="pravokutnik"></div>
<div class="header"></div>
<div class="sadrzaj">

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

<p><form action='menu.php'><input class="button" type = 'submit'value='Vrati se na meni!' action='menu.php'></input></form>

</div>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Indie+Flower" />

<style>
.header{
padding: 10px;
font-family: "Indie Flower";
font-size: 28px;
color: white;
position: absolute;
top: 0;
left:0;
height: 120px;
width:100vw;
background-color: #d3d3d3;

}


.pravokutnik{
position: fixed;
top:0;
left:0;
bottom: 0;
width: 40px;
background-color: #a3a3a3;



}
.sadrzaj{
position:absolute;
top:50px;
left: 60px;
font-family: "Indie Flower";
font-size: 25px;
color: #000;}

a{
font-family: "Indie Flower";
font-size: 25px;
color: #000;
}

a:hover, a:visited{
opacity:0.7;
font-family: "Indie Flower";
font-size: 25px;
color: #000;
}



input[type="text"]
{
    font-size:16px;
    font-family: "Indie Flower";
    color: #a3a3a3;
}


.button{
  background-color: #a3a3a3;
  border: none;
  color: #000;
  font-family: "Indie Flower";
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  font-size: 20px;
}
.button:hover{
opacity:0.7;

}</stlye>
</body>
</html>