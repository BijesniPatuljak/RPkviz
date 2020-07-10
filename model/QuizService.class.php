<?php

class QuizService
{
//--FUNKCIJE ZA KVIZ_USERS U KLASU USERS----------------------------------------------------------
//vraca usera po user_id-u
function getUserById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username FROM kviz_users WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User($row['id'], $row['username']);
	}

//vraca usera po usernameu
function getUserByUsername( $username )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username FROM kviz_users WHERE username=:username' );
			$st->execute( array( 'username' => $username ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User($row['id'], $row['username']);
	}
	
//varaca sve usere u arrayu objekata
function getAllUsers( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username FROM kviz_users ORDER BY username' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username']);
		}

		return $arr;
	}

//ubacuje u tablicu usera s novima imenom (checka ako takav vec postoji da ne dupliciramo)
function makeUser($username){

    // Provjeri prvo jel postoje user sa tim usernameom
		try
		{
			$db = DB::getConnection();
			
			$st = $db->prepare( 'SELECT * FROM kviz_users WHERE username=:username' );
			
			$st->execute( array( 'username' => $username ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() == 1 )
			throw new Exception( 'makeUser :: Korisnik sa tim imenom vec postoji.' ); //error ako je nasao match
    
    

	// Ako nas dosad nije izbacio, znaci da ne postoji korisnik sa tim imenom, pa se opet spajam na bazu i ubacujem svog novog usera
	try
	{
        $db = DB::getConnection();
        
		$st = $db->prepare( 'INSERT INTO kviz_users (username) VALUES (:username)' );

		$st->execute( array( 'username' => $username ) ); //ubacivanje novog usera
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_users]: " . $e->getMessage() ); } //error jer ne moze insertati

	
}
 
//--FUNKCIJE ZA KVIZ_QUIZZES U KLASU QUIZ-----------------------------------------------------------
//varaca sve kvizove u arrayu objekata
function getAllQuizzes( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, title FROM kviz_quizzes' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Quiz( $row['id'], $row['title']);
		}

		return $arr;
	}


//vraca kviz po quiz_id-u
function getQuizById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, title FROM kviz_quizzes WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Quiz($row['id'], $row['title']);
	}

//vraca kviz po naslovu
function getQuizByTitle($title){
		
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, title FROM kviz_quizzes WHERE title=:title' );
			$st->execute( array( 'title' => $title ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Quiz($row['id'], $row['title']);
	}
	
//ubacuje kviz sa novim titleom
function makeQuiz($title){

    // Provjeri prvo jel postoje kviz sa tim naslovom
		try
		{
			$db = DB::getConnection();
			
			$st = $db->prepare( 'SELECT * FROM kviz_quizzes WHERE title=:title' );
			
			$st->execute( array( 'title' => $title ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() == 1 )
			throw new Exception( 'makeQuiz :: Kviz sa tim naslovom vec postoji.' ); //error ako je nasao match
    
    

	// Ako nas dosad nije izbacio, znaci da ne postoji kviz sa tim naslovom, pa se opet spajam na bazu i ubacujem novi kviz
	try
	{
        $db = DB::getConnection();
        
		$st = $db->prepare( 'INSERT INTO kviz_quizzes (title) VALUES (:title)' );

		$st->execute( array( 'title' => $title ) ); //ubacivanje novog usera
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_quizzes]: " . $e->getMessage() ); } //error jer ne moze insertati

	
}

//--FUNKCIJE ZA QUIZ_QUESTIONS U KLASU QUESTIONS--------------------------------------------------
//vraca question po question_id-u
function getQuestionById($id){
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_quiz, question_number, answer_input_type, question_text, correct_answer_text FROM kviz_questions WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Question($row['id'], $row['id_quiz'], $row['question_number'], $row['answer_input_type'], $row['question_text'], $row['correct_answer_text']);
	}
//vraca array *svih* pitanja u nekom kvizu po quiz_id, ona su u polju sortirana po poretku u kvizu 
function getAllQuestionsByQuizId($id_quiz){
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_quiz, question_number, answer_input_type, question_text, correct_answer_text FROM kviz_questions WHERE id_quiz=:id_quiz ORDER BY question_number' );
			$st->execute( array( 'id_quiz' => $id_quiz ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		
        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new  Question($row['id'], $row['id_quiz'], $row['question_number'], $row['answer_input_type'], $row['question_text'], $row['correct_answer_text']);
		}

		return $arr;
	}

//ubacuje novo pitanje sa danim quiz_id, rednim_brojem_pitanja, tipom i textom_pitanja i textom_odgovora
function makeQuestion($id_quiz, $question_number, $answer_input_type, $question_text, $correct_answer_text){
    // Provjeri prvo jel postoji pitanje tog rednog broja u tom kvizu
		try
		{
			$db = DB::getConnection();
			
			$st = $db->prepare( 'SELECT * FROM kviz_questions WHERE id_quiz=:id_quiz, question_number=:question_number' );
			
			$st->execute( array( 'id_quiz' => $id_quiz, 'question_number' => $question_number ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() == 1 )
			throw new Exception( 'makeQuestion :: Pitanje tog rednog broja vec postoji u kvizu.' ); //error ako je nasao match
			
    //(opcionalno) provjeri je li pitanje duplikat u tom kvizu
        try
		{
			$db = DB::getConnection();
			
			$st = $db->prepare( 'SELECT * FROM kviz_questions WHERE id_quiz=:id_quiz, question_text=:question_text' );
			
			$st->execute( array( 'id_quiz' => $id_quiz, 'question_text' => $question_text ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() !== 1 )
			throw new Exception( 'makeQuestion :: Takvo pitanje vec postoji u kvizu.' ); //error ako je nasao match
    

	// Ako nas dosad nije izbacio, znaci da ne postoji takvo pitanje u tom kvizu, pa ga ubacujem
	try
	{
        $db = DB::getConnection();
        
		$st = $db->prepare( 'INSERT INTO kviz_questions(id_quiz, question_number, answer_input_type,  question_text, correct_answer_text) VALUES (:id_quiz, :question_number, :answer_input_type,  :question_text, :correct_answer_text)' );

		$st->execute( array( 'id_quiz' => $id_quiz, 'question_number' => $question_number, 'answer_input_type' => $answer_input_type, ' question_text' => $question_text ,'correct_answer_text' => $correct_answer_text) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_questions]: " . $e->getMessage() ); } //error jer ne moze insertati
}

//IMPLEMENT PO POTREBI_: ubacuje novo pitanje sa quiz_id, textom_pitanja i textom_odgovora (redni broj pitanja se postavlja sam po trenutnom maksimumu u tablici)


//--FUNKCIJE ZA QUIZ_PONUDJENI_ODGOVORI-------------------------------------------------------------
//vraca array svih ponudjenih odgovora u kvizu po question_id poredanih po redu pitanja (kako su uneseni)
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
	
	
//ubacuje novi ponudjeni_odgovor sa danim question_id, rednim_brojem_odgovora i textom_pitanja 
function makePonudjeniOdgovor($id_question, $ponudjeni_odgovor_number, $ponudjeni_odgovor_text){
    
	// Ako nas dosad nije izbacio, znaci da ne postoji takvo pitanje u tom kvizu, pa ga ubacujem
	try
	{
        $db = DB::getConnection();
        
		$st = $db->prepare( 'INSERT INTO kviz_ponudjeni_odgovori(id_question, ponudjeni_odgovor_number,  ponudjeni_odgovor_text) VALUES (:id_question, :ponudjeni_odgovor_number,  :ponudjeni_odgovor_text)' );
		
		$st->execute( array( 'id_question' => $id_question, 'ponudjeni_odgovor_number' => $ponudjeni_odgovor_number, 'ponudjeni_odgovor_text' => $ponudjeni_odgovor_text) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_ponudjeni_odgovori]: " . $e->getMessage() ); } //error jer ne moze insertati
}

//IMPLEMENT PO POTREBI_: ubacuje novo pitanje sa question_id i textom_pitanja (redni broj odgovora se postavlja sam po trenutnom maksimumu u tablici)

//--FUNKCIJE ZA QUIZ_RESULTS---------------------------------------------------------
//vraca rezultat po user_id i kviz_id
function getResultByUserIdAndQuizId( $id_user, $id_quiz ){
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, id_quiz FROM kviz_results WHERE id_user=:id_user, id_quiz=:id_quiz' );
			$st->execute( array( 'id_user' => $id_user, 'id_quiz' => $id_quiz ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Result($row['id'], $row['id_user'], $row['id_quiz'], $row['quiz_result']);
	}
 
//vraca listu svih rezultata po user_id sortiranu po uspjesnosti
function getAllResultsByUserId( $id_user )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, id_quiz FROM kviz_results WHERE id_user=:id_user ORDER BY quiz_result' );
			$st->execute( array( 'id_user' => $id_user) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
		
		
		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Result($row['id'], $row['id_user'], $row['id_quiz'], $row['quiz_result']);
		}

		return $arr;

	}

//vraca listu svih rezultata po id_quiz 
function getAllResultsByQuizId( $id_user )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, id_quiz FROM kviz_results WHERE id_quiz=:id_quiz' );
			$st->execute( array( 'id_quiz' => $id_quiz) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
		
		
		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Result($row['id'], $row['id_user'], $row['id_quiz'], $row['quiz_result']);
		}

		return $arr;

	}

//ubacuje novi rezultat u tablicu
function makeResult($id_user, $id_quiz, $quiz_result){

    // Provjeri prvo jel postoji rezultat tog kviza
		try
		{
			$db = DB::getConnection();
			
			$st = $db->prepare( 'SELECT * FROM kviz_results WHERE id_user=:id_user, id_quiz=id_quiz' );
			
			$st->execute( array( 'id_user' => $id_user, 'id_kviz' => $id_quiz ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() == 1 )
			throw new Exception( 'makeResult :: Rezultat vec postoji.' ); //error ako je nasao match
    
    

	// ubacujemo
	try
	{
        $db = DB::getConnection();
        
		$st = $db->prepare( 'INSERT INTO kviz_results (id_user, id_quiz, quiz_result) VALUES (:id_user, :id_quiz, :quiz_result)' );

		$st->execute( array( 'id_user' => $id_user, 'id_quiz'=> $id_quiz, 'quiz_result'=> $quiz_result ) ); //ubacivanje novog usera
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_results]: " . $e->getMessage() ); } //error jer ne moze insertati

	
}

//briše rezultat iz tablice
function deleteResult( $id_user, $id_quiz ){
// ubacujemo
	try
	{
        $db = DB::getConnection();
        
		$st = $db->prepare( 'DELETE FROM kviz_results (id_user, id_quiz, quiz_result)  WHERE id_user=:id_user, id_quiz=:id_quiz' );

		$st->execute( array( 'id_user' => $id_user, 'id_quiz'=> $id_quiz) ); //ubacivanje novog usera
	}
	catch( PDOException $e ) { exit( "PDO error [delete kviz_results]: " . $e->getMessage() ); } //error jer ne moze insertati

}

};
?>

