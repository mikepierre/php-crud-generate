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
		return "\n".$arg."\n\r";
	}

	public function createCreateMethodDeclaration($arg1) {
		$str = "";
		$str .= "public function create(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "\n}\n\r";
		return $str;
	}

	public function createReadMethodDeclaration() 
	{
		$str = "";
		$str .= "public function read() \r {\r";
		$str .= "\$sql= \"".$arg1."\";";
		$str .= "\n}\n\r";
		return $str;
	}
	
	public function createUpdateMethodDeclaration() {}
	public function createDeleteMethodDeclaration() {}

	public function createMethodDelarations() {}

}
?>