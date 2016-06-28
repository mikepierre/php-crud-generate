<?php
namespace lib;
/**
* This class connects to MySQL PDO
*/
class ConnectToMySQL
{
	/* string|null connection object */
	private $connection;

	/* array stores tables */
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
			 $this->getTables = $this->RunTablesExec(new database\GetDatabaseTables());
			 $this->RunTableFieldExec(new database\GetDatabaseFields());
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}

	/**
	*
	**/
	public function RunTablesExec(Callable $arg1) 
	{
		return $arg1($this->connection);
	}

	/**
	*
	**/
	public function RunTableFieldExec(Callable $arg1) 
	{
		return $arg1($this->connection,$this->getTables);
	}
}
?>