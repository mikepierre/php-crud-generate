<?php
namespace lib\classes;
/**
* Creates Class
*/
class CreateClass
{
	/**
	* creates the above class decleration
	* @return string 
	**/
	public function createTopClassDeclaration($arg) 
	{
		return "<?php\n class ".$arg." extends connection\n {\n";
	}

	/**
	* creates the below class declration
	* @return string
	**/
	public function createEndClassDeclaration() 
	{
		return " }\n?>\n";
	}

	/**
	* create member class variables
	* @param $arg string
	* @return string
	**/
	public function createMemeberVariables($arg1) 
	{
		return "\n private \$".$arg1.";\n\r";
	}

	/**
	* created the setter method method declarations
	* @param $arg string
	* @return string
	**/
	public function createSetterMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function ".$arg1."(\$".$arg1.") \r {\r";
		$str .= "\$this->".$arg1." = \$".$arg1.";";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* creates the crete method declarations
	* @param $arg string
	* @return string
	**/
	public function createCreateMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function create(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* creates the read method declarations
	* @param $arg string
	* @return string
	*/
	public function createReadMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function read() \r {\r";
		$str .= "\$sql= \"".$arg1."\";\n";
		$str .= "\$stmt = \$this->conn->prepare(\$sql)";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* create the update metod declarations
	* @param $arg string
	* @return string
	**/
	public function createUpdateMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function update(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* create the delete method declaration
	* @param $arg string
	* @return string
	**/
	public function createDeleteMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function delete(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "\n}\n\r";
		return $str;
	}
}
?>