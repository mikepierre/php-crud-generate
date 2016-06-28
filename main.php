<?php
// Report all errors
error_reporting(E_ALL);

// Load all classes using spl_autoload
require_once('autoload.php');

//connect to database
new lib\ConnectToMySQL('localhost','root','','medical');

?>