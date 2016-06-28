<?php
namespace lib\database;
/**
* This class gets the database tables.
*/
class GetDatabaseFields 
{
	private $array_result = array();

	private $array_sql = array();
	/**
	* invoke and show all database fields.
	* $param array $connection
	* @return array 
	**/
	public function __invoke($connection,$array) 
	{
		$array_query = array();
		foreach ($array as $key => $value) {
			foreach ($value as $k => $v) {
				$this->array_result[] = $v;
			}
		}
		print_r($this->getSqlColumns());
	}

	/**
	* get all sql columns to create statements
	* @return 
	**/
	public function getSqlColumns() 
	{
		for ($i=0; $i < count($this->array_result); $i++) { 
			$this->array_sql[] = "SHOW COLUMNS FROM ".$this->array_result[$i]."";
		}
		return $this->array_sql;
	}
}
?>