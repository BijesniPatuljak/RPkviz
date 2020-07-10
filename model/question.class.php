<?php

class Question
{
	protected $id, $id_quiz, $question_number, $answer_input_type, $question_text, $correct_answer_text;

	function __construct($id, $id_quiz, $question_number, $answer_input_type, $question_text, $correct_answer_text)
	{
		$this->id = $id;
		$this->id_quiz = $id_quiz;
		$this->question_number = $question_number;
		$this->answer_input_type = $answer_input_type;
		$this->question_text = $question_text;
		$this->correct_answer_text = $correct_answer_text;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $value ) { $this->$prop = $value; return $this; }
}

?>

