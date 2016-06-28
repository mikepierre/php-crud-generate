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
			// create mysql connection
			$this->connection = new \PDO("mysql:host=".$config['host'].";dbname=".$config['db'],
				$config['user'],$config['pass']);

			// get list of database tables
			 $this->getTables = $this->RunTablesExec(new database\GetDatabaseTables());

			// get list of database fields
			$result =  $this->RunTableFieldExec(new database\GetDatabaseFields());
			echo '<pre>';
			print_r($result);
			echo '</pre>';
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