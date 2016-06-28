<?php
namespace lib\database;
/**
* This class gets the database tables.
*/
class GetDatabaseFields 
{
	/* array|null results */
	private $array_result = array();

	/* array|null array sql */
	private $array_sql = array();

	/* array|null sql array results */
	private $sql_query_results = array();

	/* array|null get sql connection */
	private $connection;

	/**
	* invoke and show all database fields.
	* $param array $connection
	* @return array 
	**/
	public function __invoke($connection,$array) 
	{
		$this->connection = $connection;
		$array_query = array();
		foreach ($array as $key => $value) {
			foreach ($value as $k => $v) {
				$this->array_result[] = $v;
			}
		}
		return $this->getSqlResults();
	}

	/**
	* get all sql columns to create statements
	* @return array
	**/
	public function getSqlStatments() 
	{
		for ($i=0; $i < count($this->array_result); $i++) { 
			$this->array_sql[] = "SHOW COLUMNS FROM ".$this->array_result[$i]."";
		}
		return $this->array_sql;
	}

	/**
	* get all sql results.
	* @return array
	**/
	public function getSqlResults() 
	{
		$array = $this->getSqlStatments();
		for ($i=0; $i < count($array); $i++) {
			$q = $this->connection->prepare($array[$i]);
			$q->execute();
			$r = $q->fetchAll(\PDO::FETCH_ASSOC);
			$this->sql_query_results[] = array($r);
		}
		return $this->sql_query_results;
	}
}
?>