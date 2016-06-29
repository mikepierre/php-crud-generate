<?php
namespace lib\database;
/**
* This class gets the database tables.
*/
class GetDatabaseTables 
{
	/**
	* invoke and show all database tables.
	* $param array $connection
	* @return array 
	**/
	public function __invoke($connection) {
		$sql = "SHOW TABLES";
		$q = $connection->prepare($sql);
		$q->execute();
		$r = $q->fetchAll(\PDO::FETCH_ASSOC);
		return $r;
	}
}
?>