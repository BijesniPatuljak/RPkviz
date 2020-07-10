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
<input type = "submit" value="Provjeri odgovore!" ></input></form>
</body>
</html>