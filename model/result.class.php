<?php

class Result
{
	protected $id, $id_user, $id_quiz, $quiz_result;

	function __construct($id, $id_user, $id_quiz, $quiz_result)
	{
		$this->id = $id;
		$this->id_user = $id_user;
		$this->id_quiz = $id_quiz;
		$this->quiz_result = $quiz_result;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $value ) { $this->$prop = $value; return $this; }
}

?>

