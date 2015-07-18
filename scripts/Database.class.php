<?php
class Database
{
	private static $instance;
	private $link;
	
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_psw = 'abc@123';
	private $db_name = 'sales';
	
	private function __construct()
	{
		$this->link = mysqli_connect($this->db_host,$this->db_user,$this->db_psw,$this->db_name);
		mysqli_select_db($this->link,$this->db_name);
	}
	
	public static function getInstance()
	{
		if(!self::$instance) self::$instance = new Database();
		return self::$instance;
	}
	
	public function getLink()
	{
		return $this->link;
	}
}
?>