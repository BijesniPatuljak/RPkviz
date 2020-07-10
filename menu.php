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
<div class="pravokutnik"></div>
<div class="header"></div>
<div class="sadrzaj">
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
<p><input type = "submit" class="button" value="Pokreni kviz!" ></input></form></p>

<?php
if($us == "admin"){
echo '<p> Ili';
echo '<p><form action="create_quiz1.php"><input class="button" type = "submit" value="Napravi novi!"></input></form>';}
?>
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
</form>
</body>
</html>