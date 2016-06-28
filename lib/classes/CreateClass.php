<?php
namespace lib\classes;
/**
* This class gets the database tables.
*/
class CreateClass
{
	/* array name of tall table fields */
	private $table_name_array = array();

	/**
	*
	**/
	public function __invoke($arg,$arg2) 
	{
		//echo '<pre>';
		//print_r($arg2);
		//echo '</pre>';

		foreach ($arg2 as $key => $value) {
			foreach ($value as $k => $v) {
				$table_name_array[] =  $v;
			}
		}
		$array= array();
		//echo count($arg);
		for ($i=0; $i < count($arg); $i++) { 
			//echo $arg[$i];
			//print_r($table_name_array);
			foreach ($arg[$i] as $key => $value) {
				echo $value['Field'].'<br />';
			}
			echo '<b>'.$table_name_array[$i].'</b><br />';
		}
	}
}
?>