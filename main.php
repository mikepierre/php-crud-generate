<?php
// changing the content type will display how class will look.
header('Content-type: text/plain');
// Report all errors
error_reporting(E_ALL);

// Load all classes using spl_autoload
require_once('autoload.php');

//connect to database and generate all files in xml, and its classes.
$config = array(
	'database'=>array(
		'host'=>'localhost',
		'user'=>'root',
		'pass'=>'',
		'db'=>'medical'
	),
	'class_settings'=>array(
		'namespace_name'=>'some/namespace' // also creates directory at root of project.
	));
new lib\ConnectToMySQL($config);

?>