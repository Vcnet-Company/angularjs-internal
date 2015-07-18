<?php
require_once('Database.class.php');

class Adapter
{

	private static function getLink()
	{
		$db = Database::getInstance();
		return $db->getLink();
	}
	
	/*Insert non user inputs*/
	public static function insertDB($table,$cols,$vals)
	{
		$link = self::getLink();
		mysqli_query($link,'INSERT INTO `' . $table . '` (' .  $cols . ') VALUES(' .  $vals . ');');
	}
	/*Insert user inputs*/
	public static function insertDBP($table,$cols,$count,$vals,$types,$close=true)
	{
		$link = self::getLink();
		$stmt = $link->prepare('INSERT INTO ' . $table . ' ('. $cols .') VALUES(' . self::genPrepare($count) . ');');
		call_user_func_array(array($stmt,'bind_param'),self::bindParams($types,$vals));
		$stmt->execute();
		if($close) $stmt->close(); 
	}
	
	/*Retrieve a value*/
	public static function getAValue($cols,$table,$where,$vals,$types,$close=true)
	{
		$link = self::getLink();
		$stmt = $link->prepare('SELECT '. $cols .' FROM '. $table .' WHERE '. $where .' ;');
		call_user_func_array(array($stmt,'bind_param'),self::bindParams($types,$vals));
		$stmt->execute();
		$result = $stmt->get_result();
		if($close) $stmt->close();
		if($row = $result->fetch_array(MYSQLI_NUM))
		{
			return $row[0];
		}
		return -1;
	}
	/*Retrieve values*/
	public static function getRecords($cols,$table,$where,$vals,$types,$close=true)
	{
		$link = self::getLink();
		$stmt = $link->prepare('SELECT '. $cols .' FROM '. $table .' WHERE '. $where .' ;');
		call_user_func_array(array($stmt,'bind_param'),self::bindParams($types,$vals));
		$stmt->execute();
		$result = $stmt->get_result();
		$multiarray=array();$r=0;
		while($row = $result->fetch_assoc())
		{
			$multiarray[] = $row;
		}
		if($close) $stmt->close();
		return $multiarray;
	}
	
	/*Update records*/
	public static function updateRecords($table,$set,$where,$count,$types,$vals,$close=true)
	{
		$link = self::getLink();
		$stmt = $link->prepare('UPDATE '.$table.' SET '.$set.' WHERE '.$where.';');
		call_user_func_array(array($stmt,'bind_param'),self::bindParams($types,$vals));
		$stmt->execute();
		if($close) $stmt->close(); 
	}
	
	/*Delete Records*/
	public static function deleteRecords($table,$where,$types,$vals,$close=true)
	{
		$link = self::getLink();
		$stmt = $link->prepare('DELETE FROM ' . $table . ' WHERE ' . $where .';');
		call_user_func_array(array($stmt,'bind_param'),self::bindParams($types,$vals));
		$stmt->execute();
		if($close) $stmt->close(); 
	}
	
	/*Check Values' existence*/
	public static function isExists($table,$where,$vals,$types)
	{
		$link = self::getLink();
		$stmt = $link->prepare('SELECT * FROM '. $table .' WHERE '. $where .' ;');
		call_user_func_array(array($stmt,'bind_param'),self::bindParams($types,$vals));
		$stmt->execute();
		$stmt->store_result();
		$res_count = $stmt->num_rows;
		$stmt->close();
		return ($res_count == 0)?false : true;
	}
	
	/*Help functions*/
	private static function bindParams($types,$vals)
	{
		$params[] = & $types;
		$n = sizeof($vals);
		for($i=0;$i<$n;$i++)
		{
			$params[] = & $vals[$i];
		}
		return $params;
	}
	
	private static function genPrepare($count)
	{
		$val = "";
		
		for($i=1;$i<$count;$i++)
		{
			$val .= "?,";
		}
		$val .= "?";
		return $val;
	}
}
?>