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
		return "<?php\nnamespace ".$arg2.";\nclass ".$arg." extends \lib\database\Connection\n{\n";
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
		return "\nprivate \$".$arg1.";\n\n";
	}

	/**
	* created the setter method method declarations
	* @param $arg string
	* @return string
	**/
	public function createSetterMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function ".$arg1."(\$".$arg1.")\n{\r";
		$str .= "\t\$this->".$arg1." = \$".$arg1.";";
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
		$str .= "public function create(\$data)\n{\r";
		$str .= "\t\$sql= \"".$arg1."\";\n";
		$str .= "\t\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\tfor (\$i=0; \$i <count(\$data); \$i++) { \n";
		$str .= "\t\t\$q->bindParam(\$i+1,\$data[\$i]);\n";
		$str .= "\t}\n";
		$str .= "\t\$q->execute();\n";
		$str .= "\treturn true;";
		$str .= "\n}\n\n\r";
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
		$str .= "public function read()\n{\r";
		$str .= "\t\$where = '';\n";
		$str .= "\t\$limit = '';\n";
		$str .= "\tif(isset(\$this->where)) {\n";
		$str .= "\t\t\$where = ' WHERE '. \$this->where.'';\n";
		$str .= "\t} else { \n";
		$str .= "\t\t\$where = '';\n";
		$str .= "\t}\n";
		$str .= "\tif(isset(\$this->limit)) {\n";
		$str .= "\t\t\$limit = ' LIMIT '. \$this->limit.'';\n";
		$str .= "\t} else { \n";
		$str .= "\t\t\$limit = '';\n";
		$str .= "\t}\n";
		$str .= "\t\$sql= \"".$arg1."\" .\$where.\" \" .\$limit.\"\";\n";
		$str .= "\t\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\t\$q->execute();\n";
		$str .= "\t\$r = \$q->fetchAll(\PDO::FETCH_ASSOC);\n";
		$str .= "\treturn \$r;";
		$str .= "\n}\n\n\r";
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
		$str .= "public function update(\$data)\n{\r";
		$str .= "\t\$sql= \"".$arg1." \" .\$this->where.\"\";\n";
		$str .= "\t\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\tfor (\$i=0; \$i <count(\$data); \$i++) { \n";
		$str .= "\t\t\$q->bindParam(\$i+1,\$data[\$i]);\n";
		$str .= "\t}\n";
		$str .= "\t\$q->execute();\n";
		$str .= "\treturn true;";
		$str .= "\n}\n\n\r";
		return $str;
	}

	/**
	* Create the DELETE method declaration
	* @param $arg string
	* @return string
	**/
	public function createDeleteMethodDeclaration($arg1) 
	{
		$str = "";
		$str .= "public function delete()\n{\r";
		$str .= "\t\$where = '';\n";
		$str .= "\tif(isset(\$this->where)) {\n";
		$str .= "\t\t\$where = ''. \$this->where.'';\n";
		$str .= "\t} else { \n";
		$str .= "\t\t\$where = '';\n";
		$str .="\t}\n";
		$str .= "\t\$sql= \"".$arg1."\" .\$where.\"\";\n";
		$str .= "\t\$q = \$this->conn->prepare(\$sql);\n";
		$str .= "\t\$q->execute();\n";
		$str .= "\treturn true;";
		$str .= "\n}\n\n\r";
		return $str;
	}

	/**
	* Prepares the mysql file.
	* @return string
	**/
	public function createMySqlFile($arg) 
	{
		$str = "";
		$str .= "<?php\n namespace lib\database;\n class Connection extends Clauses\n {\n";
		$str .= "protected \$conn; \n";
		$str .= "private \$hosts = '".$arg['database']['host']."'; \n";
		$str .= "private \$dbname = '".$arg['database']['db']."'; \n";
		$str .= "private \$user = '".$arg['database']['user']."'; \n";
		$str .= "private \$pass = '".$arg['database']['pass']."'; \n";
		$str .= "function __construct()\n{\n";
		$str .="try {\n";
		$str .="\t\$this->conn = new \PDO('mysql:host='.\$this->hosts.';dbname='.\$this->dbname,
				\t\$this->user,\$this->pass);\n";
		$str .="} catch (\PDOException \$e) {\n";
		$str .="\treturn \$e->getMessage();\n";
		$str .="}\n";
		$str .="}\n";
		$str .="}\n";
		return $str;
	}
	/**
	* Create database connection class
	* @return bool
	**/
	public function execDatabaseConnectionClassCreation($config) 
	{
		$create_db_file = fopen(__DIR__.'/../database/Connection.php', "w");
		$fwrite = fwrite($create_db_file, $this->createMySqlFile($config));
		fclose($create_db_file);
		if ($fwrite === false) {
			return false;
		} else {
			return true;
		}
	}

	/**
	* Creates classes based on mysql tables.
	* @return bool
	**/
	public function executeDatabaseTableCreation($array_results,$config,$crud) 
	{
		$namespace = explode("\\",$config['class_settings']['namespace_name']);
		$str = "";

		for ($i=0; $i < count($namespace) ; $i++) { 
			$str .= $namespace[$i]."/";
			if (!file_exists(__DIR__.'/../../'.rtrim($str,"/"))) {
				mkdir(__DIR__.'/../../'.rtrim($str,"/"), 0777);
			}
		}
		foreach ($array_results as $key => $value) {
			$file = fopen(__DIR__.'/../../'.str_replace("\\", "/",$config['class_settings']['namespace_name']).'/'.$key.'.php', "w");
			$fwrite = fwrite($file, $this->createTopClassDeclaration($key, $config['class_settings']['namespace_name']));
			for ($i=0; $i < count($value); $i++) { 
				$fwrite .= fwrite($file, $this->createMemeberVariables($value[$i]));
				$fwrite .= fwrite($file, $this->createSetterMethodDeclaration($value[$i]));
			}
			$fwrite .= fwrite($file,$this->createCreateMethodDeclaration($crud['insert'][$key]));
			$fwrite .= fwrite($file,$this->createReadMethodDeclaration($crud['read'][$key]));
			$fwrite .= fwrite($file,$this->createUpdateMethodDeclaration($crud['update'][$key]));
			$fwrite .= fwrite($file,$this->createDeleteMethodDeclaration($crud['delete'][$key]));
			$fwrite .= fwrite($file,$this->createEndClassDeclaration());
			fclose($file);
		}
			if ($fwrite === false) {
				return false;
			} else {
				return true;
			}
	}
}
?>