<?php
class MySQLDB{
	private $link = null;	//用于存储连接成功后的“资源”
	private $host;
	private $port;
	private $user;
	private $pass;
	private $charset;
	private $dbname;
	private static $instance = null;
	static  function GetInstance($config){
		if( !(self::$instance instanceof self) ){
			self::$instance = new self($config); 
		}
		return self::$instance;
	}
	private function __clone(){}
	private function __construct($config){
		$this->host = $config['host'];
		$this->port = $config['port'];
		$this->user = $config['user'];
		$this->pass = $config['pass'];
		$this->dbname = $config['dbname'];
		$this->charset = !empty($config['charset']) ? $config['charset'] : "utf8" ;
		$this->link  =  mysqli_connect("{$this->host}:{$this->port}", "{$this->user}", "{$this->pass}","{$this->dbname}") 
			or die("连接失败");
	}
	//这个方法实现连接关闭
	function closeDB(){
		mysqli_close($this->link);
	}
	//这个方法为了执行一条增删改语句，它可以返回真假结果。
	function exec($sql){		
		$result = $this->query($sql);
		return true;
	}
	//这个方法是返回一行数据的“查询语句”，它可以返回一维数组
	function GetOneRow($sql){		
		$result = $this->query($sql);
		$rec = mysqli_fetch_assoc( $result );//取出第一行数据（其实应该只有这一行）
		mysqli_free_result( $result );	//提前释放资源（销毁结果集），否则需要等到页面结束才自动销毁
		return $rec;
	}
	//这个方法是返回多行数据的“查询语句”，它可以返回二维数组
	function GetRows($sql){		
		$result = $this->query($sql);
		$arr = array();	//空数组，用于存放要返回的结果数组（二维）
		while ( $rec = mysqli_fetch_assoc( $result ) ){
			$arr[] = $rec;	//此时，$arr就是二维数组了！
		}
		mysqli_free_result( $result );	
		return $arr;
	}	
	//这个方法是返回一个数据的“查询语句”，它可以返回一个直接值
	function GetOneData($sql){		
		$result = $this->query($sql);
		$rec = mysqli_fetch_row( $result );
		$data = $rec[0];
		mysqli_free_result( $result );
		return $data;
	}
	//统筹上面的所有方法，用于执行任何sql语句，并进行错误处理，或返回执行结果；
	private function query( $sql ){
		$result = mysqli_query($this->link,$sql);
		if( $result === false){
			echo "<p>sql语句执行失败，请参考如下信息：";
			echo "<br />错误代号：" . mysql_errno();
			echo "<br />错误信息：" . mysql_error();
			echo "<br />错误语句：" . $sql;
			die();
		}
		return $result;	//返回的是“执行结果”
	}
}
?>