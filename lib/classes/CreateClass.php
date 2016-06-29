<?php
namespace lib\classes;
/**
* Creates Class
*/
class CreateClass
{
	public function createFile() 
	{
		echo 'Write File...';
	}

	public function createTopClassDeclaration($arg) 
	{
		return "<?php\n class ".$arg." extends connection\n {\n";
	}

	public function createEndClassDeclaration() 
	{
		return " }\n?>\n";
	}

	public function createMemeberVariables($arg) 
	{
		return "\n private \$".$arg.";\n\r";
	}

	public function createSetterMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function ".$arg1."(\$".$arg1.") \r {\r";
		$str .= "\$this->".$arg1." = \$".$arg1.";";
		$str .= "\n}\n\r";
		return $str;
	}

	public function createCreateMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function create(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "\n}\n\r";
		return $str;
	}

	public function createReadMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function read() \r {\r";
		$str .= "\$sql= \"".$arg1."\";\n";
		$str .= "\$stmt = \$this->conn->prepare(\$sql)";
		$str .= "\n}\n\r";
		return $str;
	}

	public function createUpdateMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function update(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "";
		$str .= "\n}\n\r";
		return $str;
	}

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