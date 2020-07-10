<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_quizzes();
seed_table_questions();
seed_table_ponudjeni_odgovori();
seed_table_results();



// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_users (username) VALUES (:username)' );

		$st->execute( array( 'username' => 'admin' ) ); //ubacivanje admina  - on ce jedini moci dodavati kvizove
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_users]: " . $e->getMessage() ); }

	//echo "Ubacio u tablicu kviz_users.<br />";
}//DONE


// ------------------------------------------
function seed_table_quizzes()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_quizzes(title) VALUES (:title)' );

		$st->execute( array( 'title' => 'Koliko dobro poznajete Daria Bogovića?' ) ); // kviz za darija
		$st->execute( array( 'title' => 'Koliko dobro poznajete Ivu Tutiš?' ) ); // kviz za ivu

	}
	catch( PDOException $e ) { exit( "PDO error [kviz_quizzes]: " . $e->getMessage() ); }

	//echo "Ubacio u tablicu kviz_quizzes.<br />";
}//DONE


// ------------------------------------------
function seed_table_questions()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_questions(id_quiz, question_number, answer_input_type,  question_text, correct_answer_text) VALUES (:id_quiz, :question_number, :answer_input_type,  :question_text, :correct_answer_text)' );

		//pitanja za darijev kviz - 2 checkbox, 1 text
		$st->execute( array( 'id_quiz' => 1, 'question_number' => 1, 'answer_input_type' => 'checkbox', 'question_text' => 'Koja je Dariju najdraža boja kose na djevojci?' ,'correct_answer_text' => 'Crvena') );
		$st->execute( array( 'id_quiz' => 1, 'question_number' => 2, 'answer_input_type' => 'text', 'question_text' => 'Kako se zove Darijev izviđački odred?' ,'correct_answer_text' => 'Dubrava') );
		$st->execute( array( 'id_quiz' => 1, 'question_number' => 3, 'answer_input_type' => 'checkbox', 'question_text' => 'Koja je Dariju najdraži Youtube kanal?' ,'correct_answer_text' => 'Buff Dudes') );
		
		//pitanja za ivin kviz - 1 checkbox, 2 text
		$st->execute( array( 'id_quiz' => 2, 'question_number' => 1, 'answer_input_type' => 'checkbox', 'question_text' => 'Koji je Ivin najdraži medij za crtanje?' ,'correct_answer_text' => 'Pastele') );
		$st->execute( array( 'id_quiz' => 2, 'question_number' => 2, 'answer_input_type' => 'text', 'question_text' => 'Koji je Ivin najceći strah?' ,'correct_answer_text' => 'Strah od visine') );
		$st->execute( array( 'id_quiz' => 2, 'question_number' => 3, 'answer_input_type' => 'text', 'question_text' => 'Da li je Iva alergična na kikiriki?' ,'correct_answer_text' => 'Ne') );
		
	
	}
	catch( PDOException $e ) { exit( "PDO error [kviz_questions]: " . $e->getMessage() ); }

	//echo "Ubacio u tablicu kviz_questions.<br />";
}
//DONE

//-------------------------------------------
function seed_table_ponudjeni_odgovori()
{
	$db = DB::getConnection();

	
	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_ponudjeni_odgovori(id_question, ponudjeni_odgovor_number,  ponudjeni_odgovor_text) VALUES (:id_question, :ponudjeni_odgovor_number,  :ponudjeni_odgovor_text)' );

		//ponudjeni odgovori za darijev kviz - 2 checkbox * 3 odgovora
		
		$st->execute( array( 'id_question' => 1, 'ponudjeni_odgovor_number' => '1', 'ponudjeni_odgovor_text' => 'Crvena') );
		$st->execute( array( 'id_question' => 1, 'ponudjeni_odgovor_number' => '2', 'ponudjeni_odgovor_text' => 'Smeđa') );
		$st->execute( array( 'id_question' => 1, 'ponudjeni_odgovor_number' => '3', 'ponudjeni_odgovor_text' => 'Plava') );
		
		
		$st->execute( array( 'id_question' => 3, 'ponudjeni_odgovor_number' => '1', 'ponudjeni_odgovor_text' => 'Pewdiepie') );
		$st->execute( array( 'id_question' => 3, 'ponudjeni_odgovor_number' => '2', 'ponudjeni_odgovor_text' => 'Buff Dudes') );
		$st->execute( array( 'id_question' => 3, 'ponudjeni_odgovor_number' => '3', 'ponudjeni_odgovor_text' => 'Cake Making With Megan') );
		
		
		//pitanja za ivin kviz - 1 checkbox * 3 odgovora
		
        $st->execute( array( 'id_question' => 4, 'ponudjeni_odgovor_number' => '1', 'ponudjeni_odgovor_text' => 'Pastele') );
		$st->execute( array( 'id_question' => 4, 'ponudjeni_odgovor_number' => '2', 'ponudjeni_odgovor_text' => 'Akvarel') );
		$st->execute( array( 'id_question' => 4, 'ponudjeni_odgovor_number' => '3', 'ponudjeni_odgovor_text' => 'Olovka') );
		
	
	}
	catch( PDOException $e ) { exit( "PDO error [kviz_ponudjeni_odgovori]: " . $e->getMessage() ); }

	//echo "Ubacio u tablicu kviz_ponudjeni_odgovori.<br />";
}
//DONE

function seed_table_results()
{
	$db = DB::getConnection();

	//try
	//{
		//$st = $db->prepare( 'INSERT INTO kviz_results (id_user, id_quiz, quiz_result) VALUES (:id_user, :id_quiz, :quiz_result)' );
        
        //nista necu ubaciti, ali ostavljam funkciju za checking po potrebi
	//}
	//catch( PDOException $e ) { exit( "PDO error [insert kviz_results]: " . $e->getMessage() ); }

	//echo "Ubacio u tablicu kviz_results.<br />";
}//DONE

?> 
 
