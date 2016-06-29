<?php
namespace lib\database;
/**
* This class provides the methods for 
* establishing clauses
*/
class Clauses 
{
	/* string where */
	private $where;

	/* string limit */
	private $limit;

	/**
	* this method appends where clause to sql statment.
	* @param string $where
	* @return this
	*/
	public function where($where) 
	{
		$this->where = $where;
		$this;
	}

	/** 
	* this method appends limit to sql statment.
	* @param string $limit
	* @return this
	**/
	public function limit($limit) 
	{
		$this->limit = $limit;
		$this;
	}


}
?>