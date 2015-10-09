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
Editor::inst( $db, 'clientsxmachines' )
	->fields(
		Field::inst( 'clientsxmachines.id' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'clientsxmachines.machine_id' )->options( 'machines', 'id', 'name' ),
		Field::inst( 'clientsxmachines.client_id' )->options( 'clients', 'id', 'name' ),
		Field::inst( 'machines.name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'clients.name' )->validator( 'Validate::notEmpty' )
	)
	->leftJoin( 'machines', 'machines.id', '=', 'clientsxmachines.machine_id' )
	->leftJoin( 'clients', 'clients.id', '=', 'clientsxmachines.client_id' )
	->process( $_POST )
	->json();
