<?php
namespace lib;
/**
* This class connects to MySQL PDO
*/
class ConnectToMySQL
{
	/* string|null connection object */
	private $connection;
	
	/**
	* construct to build the connection to 
	* the mysql database.
	**/
	function __construct($host,$user,$pass,$db)
	{
		try {
			$this->connection = new \PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
			 $this->RunTables(new database\GetDatabaseTables());
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}

	public function RunTables(Callable $arg1) {
		return $arg1($this->connection);
	}
}
?>