<?php
namespace lib\database;
/**
* This class provides the methods for 
* establishing clauses
*/
class Clauses 
{
	private $where;
	private $limit;

	/**
	* this method appends where clause to sql statment.
	* @param string where
	* @return this
	*/
	public function where($where) 
	{
		$this->where = $where;
		$this;
	}

	public function limit($limit) 
	{
		$this->limit = $limit;
		$this;
	}


}
?>