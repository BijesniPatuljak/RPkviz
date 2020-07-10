<?php

// Stvaramo tablice u bazi (ako veÄ‡ ne postoje od ranije).
require_once __DIR__ . '/db.class.php';

create_table_users();
create_table_quizzes();
create_table_questions();
create_table_ponudjeni_odgovori();
create_table_results();


// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->prepare( 
			'SHOW TABLES LIKE :tblname'
		);

		$st->execute( array( 'tblname' => $tblname ) );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}

//DONE - table koji sadrzi sve usere, admin ce unutra biti po defaultu kao user
function create_table_users()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_users' ) )
		exit( 'Tablica kviz_users vec postoji. Obrisite ju pa probajte ponovno.' );


	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_users]: " . $e->getMessage() ); }

	//echo "Napravio tablicu kviz_users.<br />";
}

//DONE - table koji sadrzi identifikaciju i title kviza
function create_table_quizzes()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_quizzes' ) )
		exit( 'Tablica kviz_quizzes vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_quizzes (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'title varchar(250) NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_quizzes]: " . $e->getMessage() ); }

	//echo "Napravio tablicu kviz_quizzes.<br />";
}

//DONE - table koji sadrzi ID kviza kojem pripada, redni_broj, i text pitanja, kao i tocan odgovor na nj te oblik inputa odgovora
function create_table_questions()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_questions' ) )
		exit( 'Tablica kviz_questions vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_questions (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_quiz INT NOT NULL,' .
			'question_number INT NOT NULL,'.
			'answer_input_type varchar(50) NOT NULL,'. //moze biti 'checkbox' (onda trazi u kviz_ponudjeni_odgovori) ili 'textbox'
			'question_text varchar(1000) NOT NULL,'.
			'correct_answer_text varchar(1000) NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_questions]: " . $e->getMessage() ); }

	//echo "Napravio tablicu kviz_questions.<br />";
}

//DONE - table koji sadrzi ID kviza i pitanja kojem pripada ponudjeni odgovor, redni_broj i text ponudjenog odgovora
function create_table_ponudjeni_odgovori()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_ponudjeni_odgovori' ) )
		exit( 'Tablica kviz_ponudjeni_odgovori vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_ponudjeni_odgovori (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_question INT NOT NULL,' .
			'ponudjeni_odgovor_number INT NOT NULL,'.
			'ponudjeni_odgovor_text varchar(1000) NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_ponudjeni_odgovori]: " . $e->getMessage() ); }

	//echo "Napravio tablicu kviz_ponudjeni_odgovori.<br />";
}

//DONE - table koji sadrzi id_usera i id_kviza koji je polagao, te njegove rezultate na njemu. Ako kviz nije polagao, rezultat ne postoji.
function create_table_results()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_results' ) )
		exit( 'Tablica kviz_results vec postoji. Obrisite ju pa probajte ponovno.' );


	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_results (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_user INT NOT NULL,' .
			'id_quiz INT NOT NULL,'.
			'quiz_result int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_answers]: " . $e->getMessage() ); }

	//echo "Napravio tablicu kviz_answers.<br />";
}

?> 
