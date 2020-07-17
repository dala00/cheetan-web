<?php
	require_once( 'config.php' );
	require_once( 'cheetan/cheetan.php' );

function action( &$c )
{
	
	$c->set("Name","Fred Irving Johnathan Bradley Peppergill");
	$c->set("FirstName",array("John","Mary","James","Henry"));
	$c->set("LastName",array("Doe","Smith","Johnson","Case"));
	$c->set("Class",array(array("A","B","C","D"), array("E", "F", "G", "H"),
		  array("I", "J", "K", "L"), array("M", "N", "O", "P")));
	
	$c->set("contacts", array(array("phone" => "1", "fax" => "2", "cell" => "3"),
		  array("phone" => "555-4444", "fax" => "555-3333", "cell" => "760-1234")));
	
	$c->set("option_values", array("NY","NE","KS","IA","OK","TX"));
	$c->set("option_output", array("New York","Nebraska","Kansas","Iowa","Oklahoma","Texas"));
	$c->set("option_selected", "NE");
}
?>
