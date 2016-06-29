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
	
	/* array get table fields */
	private $getTableFields;

	/* array config */
	private $config;
	
	/**
	* construct to build the connection to 
	* the mysql database.
	**/
	function __construct($config)
	{
		try {
			$this->config = $config;
			// create mysql connection
			$this->connection = new \PDO("mysql:host=".$config['database']['host'].";dbname=".$config['database']['db'],
				$config['database']['user'],$config['database']['pass']);

			// get list of database tables
			 $this->getTables = $this->RunTablesExec(new database\GetDatabaseTables());

			// get list of database fields
			$this->getTableFields = $this->RunTableFieldExec(new database\GetDatabaseFields());

			// prepare are create classes.
			$this->RunCreateClassExec(new classes\PrepareClass());
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

	/**
	*
	**/
	public function RunCreateClassExec(Callable $arg1) 
	{
		return $arg1($this->getTableFields,$this->getTables,$this->config);
	}
}
?>