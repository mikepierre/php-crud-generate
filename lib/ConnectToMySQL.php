<?php
namespace lib;
/**
* This class connects to MySQL PDO
*/
class ConnectToMySQL
{
	/* string|null connection object */
	private $connection;

	private $getTables;
	
	/**
	* construct to build the connection to 
	* the mysql database.
	**/
	function __construct($config)
	{
		try {
			$this->connection = new \PDO("mysql:host=".$config['host'].";dbname=".$config['db'],
				$config['user'],$config['pass']);
			 $this->getTables = $this->RunTables(new database\GetDatabaseTables());
			 print_r($this->getTables);
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}

	public function RunTables(Callable $arg1) {
		return $arg1($this->connection);
	}
}
?>