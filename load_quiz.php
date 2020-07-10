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


function getAllPonudjeniOdgovoriByQuestionId($id_question){
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_question, ponudjeni_odgovor_number, ponudjeni_odgovor_text FROM kviz_ponudjeni_odgovori WHERE id_question=:id_question ORDER BY ponudjeni_odgovor_number' );
			$st->execute( array( 'id_question' => $id_question ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		
        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new  Ponudjeni_Odgovor($row['id'], $row['id_question'], $row['ponudjeni_odgovor_number'], $row['ponudjeni_odgovor_text']);
		}

		return $arr;
	}




?>

<div class="pravokutnik"></div>
<div class="header"></div>
<div class="sadrzaj">
<form action="rezultat.php" method="post">


<?php
session_start();
$qz = new QuizService();
$id_qz=$_POST['id_kviza'];
$_SESSION['id_kviza']=$id_qz;
$trenutni_kviz = $qz-> getQuizById( $id_qz );
$pitanja=$qz->getAllQuestionsByQuizId( $id_qz );

	foreach ($pitanja as $pitanje){
echo '<p>' . $pitanje->question_number . ') ' . $pitanje->question_text . '</p>';
if($pitanje->answer_input_type == 'text') echo '<input type="text" name="'. $pitanje->question_number . '" ></input>';
else{
$odgovori = getAllPonudjeniOdgovoriByQuestionId($pitanje->id);
		foreach($odgovori as $odgovor) {
echo '<input type="radio" name = ' . $pitanje->question_number . ' id = ' . $odgovor->ponudjeni_odgovor_text . ' value="' . $odgovor->ponudjeni_odgovor_text . '">';
echo '<label for="' . $odgovor->ponudjeni_odgovor_text . '" value="' . $odgovor->ponudjeni_odgovor_text . '">' . $odgovor->ponudjeni_odgovor_text . '<br>';
		}

	}

}


?>
<input class="button" type = "submit" value="Provjeri odgovore!" ></input></form>

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