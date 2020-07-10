<?php

class Ponudjeni_Odgovor
{
	protected $id, $id_question, $ponudjeni_odgovor_number, $ponudjeni_odgovor_text;

	function __construct($id, $id_question, $ponudjeni_odgovor_number, $ponudjeni_odgovor_text)
	{
		$this->id = $id;
		$this->id_question = $id_question;
		$this->ponudjeni_odgovor_number = $ponudjeni_odgovor_number;
		$this->ponudjeni_odgovor_text = $ponudjeni_odgovor_text;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $value ) { $this->$prop = $value; return $this; }
}

?>

