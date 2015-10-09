<?php

/* 

System created by Cristian Blanco
crismablanco@gmail.com

*/

// DataTables PHP library
include( "./php/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'clients' )
	->fields(
		Field::inst( 'id' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'name' )->validator( 'Validate::notEmpty' )
	)
	->process( $_POST )
	->json();
