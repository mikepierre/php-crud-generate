<?php
namespace lib\database;
/**
* 
*/
class GetDatabaseTables 
{
	public function __invoke($connection) {
		$sql = "SHOW TABLES";
		$q = $connection->prepare($sql);
		$q->execute();
		$r = $q->fetchAll(\PDO::FETCH_ASSOC);
		print_r($r);
	}
}
?>