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
	public function createTopClassDeclaration($arg,$arg2) 
	{
		return "<?php\n namespace ".$arg2.";\n class ".$arg." extends connection\n {\n";
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
	* creates the CREATE method declarations
	* @param $arg string
	* @return string
	**/
	public function createCreateMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function create(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";\n";
		$str .= "\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\$q->execute();\n";
		$str .= "return 1;";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* creates the READ method declarations
	* @param $arg string
	* @return string
	*/
	public function createReadMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function read() \r {\r";
		$str .= "\$sql= \"".$arg1."\";\n";
		$str .= "\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\$q->execute();\n";
		$str .= "\$r = \$q->getechAll(\PDO::FETCH_ASSOC);\n";
		$str .= "return \$r;";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* create the UPDATE metod declarations
	* @param $arg string
	* @return string
	**/
	public function createUpdateMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function update(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";\n";
		$str .= "\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\$q->execute();\n";
		$str .= "return 1;";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	* create the DELETE method declaration
	* @param $arg string
	* @return string
	**/
	public function createDeleteMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function delete(\$data) \r {\r";
		$str .= "\$sql= \"".$arg1."\";\n";
		$str .= "\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\$q->execute();\n";
		$str .= "return \$r;";
		$str .= "\n}\n\r";
		return $str;
	}

	/**
	*
	**/
	public function createMySqlFile($arg) 
	{
		$str = "";
		$str .= "<?php\n namespace lib\database;\n class Connection extends Clauses\n {\n";
		$str .= "private \$conn; \n";
		$str .= "private \$hosts = '".$arg['database']['host']."'; \n";
		$str .= "private \$dbname = '".$arg['database']['db']."'; \n";
		$str .= "private \$user = '".$arg['database']['user']."'; \n";
		$str .= "private \$pass = '".$arg['database']['pass']."'; \n";
		$str .= "function __construct()\n{\n";
		$str .="try {\n";
		$str .="\$this->conn = new \PDO('mysql:host='.\$this->host.';dbname='.\$this->dbname,
				\$this->user,\$this->pass);\n";
		$str .="} catch (\PDOException \$e) {\n";
		$str .="return \$e->getMessage();\n";
		$str .="}\n";
		$str .="}\n";
		return $str;
	}

	/**
	*
	**/
	public function execDatabaseConnectionClassCreation($config) 
	{
		$create_db_file = fopen(__DIR__.'/../database/Connection.php', "w");
		fwrite($create_db_file, $this->createMySqlFile($config));
		fclose($create_db_file);
		return true;
	}

	/**
	*
	**/
	public function executeDatabaseTableCreation($array_results,$config) 
	{
		
		foreach ($array_results as $key => $value) {

			mkdir(__DIR__.'/../../'.$config['class_settings']['namespace_name'].'.php', "w");

			$file = fopen(__DIR__.'/../../'.$config['class_settings']['namespace_name'].'.php', "w");
			fwrite($file, $this->createTopClassDeclaration($key, $config['class_settings']['namespace_name']));
			for ($i=0; $i < count($value); $i++) { 
				fwrite($file, $this->createMemeberVariables($value[$i]));
				fwrite($file, $this->createSetterMethodDeclaration($value[$i]));
				echo $this->createMemeberVariables($value[$i]); 
				echo $this->createSetterMethodDeclaration($value[$i]);
			}
			fwrite($file,$this->createCreateMethodDeclaration($insert[$key]));
			fwrite($file,$this->createReadMethodDeclaration($read[$key]));
			fwrite($file,$this->createUpdateMethodDeclaration($update[$key]));
			fwrite($file,$this->createDeleteMethodDeclaration($delete[$key]));
			fwrite($file,$this->createEndClassDeclaration());
			fclose($file);
		}
		return true;
	}
}
?>