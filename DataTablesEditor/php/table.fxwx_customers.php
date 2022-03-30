<?php

/*
 * Editor server script for DB table fxwx_customers
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'fxwx_customers', 'customer_id' )
	->fields(
		Field::inst( 'shop_id' ),
		Field::inst( 'notes' ),
		Field::inst( 'status' ),
		Field::inst( 'created_on' )
			->validator( 'Validate::dateFormat', array( 'format'=>'Y-m-d H:i:s' ) )
			->getFormatter( 'Format::datetime', array( 'from'=>'Y-m-d H:i:s', 'to'  =>'Y-m-d H:i:s' ) )
			->setFormatter( 'Format::datetime', array( 'to'  =>'Y-m-d H:i:s', 'from'=>'Y-m-d H:i:s' ) ),
		Field::inst( 'created_by_user_id' ),
		Field::inst( 'updated_on' )
			->validator( 'Validate::dateFormat', array( 'format'=>'Y-m-d H:i:s' ) )
			->getFormatter( 'Format::datetime', array( 'from'=>'Y-m-d H:i:s', 'to'  =>'Y-m-d H:i:s' ) )
			->setFormatter( 'Format::datetime', array( 'to'  =>'Y-m-d H:i:s', 'from'=>'Y-m-d H:i:s' ) ),
		Field::inst( 'updated_by_user_id' ),
		Field::inst( 'language_pref' ),
		Field::inst( 'prefix' ),
		Field::inst( 'firstname' ),
		Field::inst( 'lastname' ),
		Field::inst( 'postfix' ),
		Field::inst( 'address1' ),
		Field::inst( 'address2' ),
		Field::inst( 'address3' ),
		Field::inst( 'city' ),
		Field::inst( 'state' ),
		Field::inst( 'postalcode' ),
		Field::inst( 'country' ),
		Field::inst( 'phone1' ),
		Field::inst( 'phone2' ),
		Field::inst( 'phone3' ),
		Field::inst( 'phone4' ),
		Field::inst( 'phone5' ),
		Field::inst( 'phone6' ),
		Field::inst( 'can_sms' ),
		Field::inst( 'email' )
	)
	->process( $_POST )
	->json();
