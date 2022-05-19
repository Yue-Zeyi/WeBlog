<?php
class BaseModel{
    
	
	function __construct(){
		$config = array(
			'host' => "localhost",
			'port' => 3306,
			'user' => "weblog",
			'pass' => "weblog",
			'charset' => "utf8",
			'dbname' => "weblog"
		);
		$this->_dao = MySQLDB::GetInstance($config);
	}		
}
