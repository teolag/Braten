<?php
class DatabaseConnection {
	private $connection;
	
	public function __construct($DBsettings, $username="", $password="", $name="") {
		if(!is_array($DBsettings) && $username!="" && $password!="" && $name!="") {
			$DBsettings=array(
				"server"=>$DBsettings,
				"username"=>$username,
				"password"=>$password,
				"name"=>$name
			);
		}	
		$this->connection = mysql_connect($DBsettings['server'], $DBsettings['username'], $DBsettings['password']) or die("Could not connect to database: " . mysql_error());
		mysql_set_charset('utf8'); 
		mysql_select_db($DBsettings['name'], $this->connection) or die("Could not find selected database '".$DBsettings['name']."'");
	}
	
	public function mySQLconnection($DBsettings) {
		$this->__construct($DBsettings);
	}

	public function __destruct() {
		mysql_close($this->connection);
	}
	
	public function getArray($query) {
		$temp = $this->query($query);
		$output = array();
		while ($line = mysql_fetch_assoc($temp))	{
			$output[] = $line;
		}
		mysql_free_result($temp);
		return $output;
	}

	public function getRow($query) {
		$temp = $this->query($query);
		$temp = mysql_fetch_assoc($temp);
		return $temp;
	}
	
	public function getValue($query) {
		$temp = $this->query($query);
		$temp = mysql_fetch_row($temp);
		return $temp[0];
	}	
	
	public function execute($query) {
		mysql_query($query,$this->connection) or die("SQL execution failed: " . $query . "<br />" . mysql_error());
	}

	public function querytable($query,$header) {
		echo "<table class='querytable'>\n";
		echo "\t<caption>".$header."</caption>\n";
		$temp = $this->query($query);
		echo "\t<thead>\n\t\t<tr>\n";
		$numfields = mysql_num_fields($temp);
		for ($i=0; $i < $numfields; $i++) { 
			echo "\t\t\t<th>".mysql_field_name($temp, $i)."</th>\n"; 
		}
		echo "\t\t</tr>\n\t</thead>\n\t<tbody>";
		while ($line = mysql_fetch_assoc($temp))	{
			echo "\t\t<tr>\n";
			foreach($line as $l){
				echo "\t\t\t<td>".$l."</td>\n";
			}		
			echo "\t\t</tr>\n";
		}
		mysql_free_result($temp);
		echo "\t<tbody>\n</table>";
	}

	public function insert($table, $arr) {
		foreach($arr as $c => $v) {
			if(is_array($v)) $arr[$c] = implode($v,", ");
			$arr[$c] = $this->fix2db($v);
		}
		$columns = implode(array_keys($arr),"`, `");
		$values = implode($arr,"', '");
		
		$sql = "INSERT INTO ". $table ."(`".$columns."`) VALUES('".$values."')";
		$this->execute($sql);
		return mysql_insert_id();
	}

	public function update($table, $arr, $idName, $id) {
		foreach($arr as $c => $v) {
			if(is_array($v)) $v = implode($v,", ");
			$v = $this->fix2db($v);
			$sets[$c] = "`". $c . "`='" . $v . "'";
		}
		$sets = implode($sets,", ");
		
		$sql = "UPDATE ". $table ." SET ".$sets." WHERE ".$idName."='" . $id . "'";
		$this->execute($sql);
	}

	public function query($query) {
		$out = mysql_query($query,$this->connection) or die("SQL failed: " . $query . "<br />" . mysql_error() . "<br />" . mysql_errno());
		return $out;
	}
	
	
	private function fix2db($text) {
		if(!get_magic_quotes_gpc()) {
			$text = addslashes($text);
		}
		return $text;
	}
	
}
?>