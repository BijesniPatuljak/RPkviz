<?php

//prikazuj sve errore
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Učitaj definiciju spoja na bazu podataka.
require_once __DIR__ . '/database/' . 'db.class.php';

//učitaj i izvrši skripte za kreiranje i punjenje tablica podataka u bazi JEDNOM za doma i jednom za rp2
require_once __DIR__ . '/database/' . 'create_tables.php';
require_once __DIR__ . '/database/' . 'seed_tables.php';

// Automatsko učitavanja klasa iz modela kad se pozove new.
spl_autoload_register(  function( $class_name ) 
{
	// Imena datoteke od klasa će biti napisana malim slovima.
	// Npr. za klasu User će biti spremljeno u user.class.php
	$filename = strtolower($class_name) . '.class.php';
	$file = __DIR__ . '/model/' . $filename;

	if( file_exists($file) === false )
	    return false;

	require_once ($file);
}  );

?>
