<?php
namespace lib\classes;
/**
* This class prepares the tables 
* in order to create the classes. 
*/
class PrepareClass extends CreateClass
{
	/* array name of  table fields */
	private $table_name_array = array();

	/* array get all table fiel values */
	private $array_field_value = array();

	/* array get table values */
	private $array_table_value = array();

	/* array fields of the array */
	private $array_fields = array();

	/* array array keys */
	private $array_keys = array();

	/* array results */
	private $array_results = array();

	private $config = array();

	/**
	* invoke this class to be callable.
	**/
	public function __invoke($arg,$arg2,$arg3) 
	{
		$this->array_field_value = $arg;
		$this->array_table_value = $arg2;
		$this->config = $arg3;

		$this->getTableNameArray();
		$this->getFieldsArray();
		$this->array_results = $this->getFieldValueArray();

		$insert = $this->getInsertStatment();
		$read = $this->getSelectStatement();
		$delete = $this->getDeleteStament();
		$update = $this->getUpdateStatement();

		// create connection config class
		$this->execDatabaseConnectionClassCreation($this->config);
		$this->executeDatabaseTableCreation($this->array_results,$this->config);

		// create all classes
		/*
		foreach ($this->array_results as $key => $value) {
			// write file 
			//$file = fopen(__DIR__.'/../../dirname/'.$key.'.php', "w");
			echo $this->createTopClassDeclaration($key, $this->config['class_settings']['namespace_name']);
			//fwrite($file, $this->createTopClassDeclaration($key));
			for ($i=0; $i < count($value); $i++) { 
				//fwrite($file, $this->createMemeberVariables($value[$i]));
				//fwrite($file, $this->createSetterMethodDeclaration($value[$i]));
				echo $this->createMemeberVariables($value[$i]); 
				echo $this->createSetterMethodDeclaration($value[$i]);
			}
			//fwrite($file,$this->createCreateMethodDeclaration($insert[$key]));
			//fwrite($file,$this->createReadMethodDeclaration($read[$key]));
			//fwrite($file,$this->createUpdateMethodDeclaration($update[$key]));
			//fwrite($file,$this->createDeleteMethodDeclaration($delete[$key]));
			//fwrite($file,$this->createEndClassDeclaration());

			echo $this->createCreateMethodDeclaration($insert[$key]);
			echo $this->createReadMethodDeclaration($read[$key]);
			echo $this->createUpdateMethodDeclaration($update[$key]);
			echo $this->createDeleteMethodDeclaration($delete[$key]);
			echo $this->createEndClassDeclaration();
			//fclose($file);
		}*/
	}

	/**
	* Add value from table name to table name array var.
	**/
	public function getTableNameArray()
	{
		foreach ($this->array_table_value as $key => $value) {
			foreach ($value as $k => $v) {
				$this->table_name_array[] =  $v;
			}
		}
	}

	/**
	* Add fields based on table name and field.
	*/
	public function getFieldsArray() 
	{
		for ($i=0; $i < count($this->array_field_value); $i++) { 
			foreach ($this->array_field_value[$i] as $key => $value) {;
				$this->array_fields[] = array($value['Field'],$this->table_name_array[$i]);
			}
		}
	}
	/**
	* Create array of all values and create key based on the values from array.
	* @return array
	*/
	public function getFieldValueArray() 
	{
		$array = array();
		for ($i=0; $i <count($this->array_fields) ; $i++) { 
			$array[$this->array_fields[$i][1]][] = $this->array_fields[$i][0];
		}
		return $array;
	}

	/**
	* Get the generated insert statments
	* @return array
	**/
	public function getInsertStatment() 
	{
		$array = array();
		$array_keys = array_keys($this->array_results);
		$str = "";
		$question_mark = "";
		for ($i=0; $i <count($array_keys); $i++) { 
			foreach ($this->array_results as $key => $value) {
				if($key === $array_keys[$i]) {
					for ($j=0; $j < count($value); $j++) { 
						$str .= $value[$j].',';
						$question_mark .= '?,';
						$array[$key] = 'INSERT INTO '.$key.' '.rtrim($str, ","). ' VALUES ('.rtrim($question_mark,',').')';
					}
					$str ="";
					$question_mark = "";
				}
			}
		}
		return $array;
	}

	/**
	* get the generated select statements
	* @return array
	**/
	public function getSelectStatement() 
	{
		$array = array();
		$str = "";
		$array_keys = array_keys($this->array_results);
		for ($i=0; $i <count($array_keys); $i++) { 
			foreach ($this->array_results as $key => $value) {
				if($key === $array_keys[$i]) {
					for ($j=0; $j < count($value); $j++) { 
						$str .= $value[$j].',';
						$array[$key] = 'SELECT '.rtrim($str, ","). ' FROM '.$key.'';
					}
					$str ="";
				}
			}
		}
		return $array;
	}

	/**
	* get the generated delete statments
	* @return array
	**/
	public function getDeleteStament() 
	{
		$array = array();
		$str = "";
		$array_keys = array_keys($this->array_results);
		for ($i=0; $i <count($array_keys); $i++) { 
			foreach ($this->array_results as $key => $value) {
				if($key === $array_keys[$i]) {
					for ($j=0; $j < count($value); $j++) { 
						$str .= $value[$j].',';
						$array[$key] = 'DELETE FROM '.$key.' WHERE ';
					}
					$str ="";
				}
			}
		}
		return $array;
	}

	/**
	* get generated update statement
	* @return array
	**/
	public function getUpdateStatement() 
	{
		$array = array();
		$array_keys = array_keys($this->array_results);
		$str = "";
		for ($i=0; $i <count($array_keys); $i++) { 
			foreach ($this->array_results as $key => $value) {
				if($key === $array_keys[$i]) {
					for ($j=0; $j < count($value); $j++) { 
						$str .= $value[$j].'=?, ';
						$array[$key] = 'UPDATE '.$key.' SET '.rtrim($str, ",").'WHERE';
					}
					$str ="";
					$question_mark = "";
				}
			}
		}
		return $array;
	}
}
?>