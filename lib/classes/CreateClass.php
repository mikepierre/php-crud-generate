<?php
namespace lib\classes;
/**
* This class gets the database tables.
*/
class CreateClass 
{
	/**
	*
	**/
	public function __invoke($arg) 
	{
		echo '<pre>';
		print_r($arg);
		echo '</pre>';
	}
}
?>