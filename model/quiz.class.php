<?php

class Quiz
{
	protected $id, $title;

	function __construct( $id, $title )
	{
		$this->id = $id;
		$this->title = $title;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
