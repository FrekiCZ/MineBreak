<?php
class MySQL {
	
	private $host;
	private $user;
	private $pass;
	private $db;
	private $charset = "utf8";
	public $connected = false;
	
	private $statement;
	
	public function setData($host, $user, $pass, $db) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
	}
	
	public function setCharset($charset) {
		$this->charset = $charset;
	}
	
	public function connect() {
		try {
			$this->statement = mysql_connect($this->host, $this->user, $this->pass) or die($this->exception("Can't connect to mysql server !"));
			$this->connected = true;
		} catch(Exception $ex) {
			echo $ex->getMessage();
			mysql_error();
		}
		mysql_select_db($this->db, $this->statement);
		mysql_query("SET NAMES '" . $this->charset . "'", $this->statement);
	}
	
	public function query($query) {
		return mysql_query($query, $this->statement);
	}
	
	public function fetch($query, $row) {
		$query_l = $this->query($query);
		while($table_row = mysql_fetch_array($query_l)) {
			return $table_row[$row];
		}
	}
	
	private function exception($message) {
		throw new Exception($message);
	}
	
}