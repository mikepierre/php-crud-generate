<?php
namespace lib\classes;
/**
* This class prepares the tables 
* in order to create the classes. 
*/
class CreateClass
{
	/* array name of  table fields */
	private $table_name_array = array();

	/* array get all table fiel values */
	private $array_field_value = array();

	/* array get table values */
	private $array_table_value = array();

	/* array fields of the array */
	private $array_fields = array();

	/**
	*
	**/
	public function __invoke($arg,$arg2) 
	{
		$this->array_field_value = $arg;
		$this->array_table_value = $arg2;
		$this->getTableNameArray();
		$this->getFieldsArray();
		$r = $this->getFieldValueArray();
		$array = array();
		for ($i=0; $i < ; $i++) { 
			# code...
		}
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
}
?>