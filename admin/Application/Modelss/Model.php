<?php
class ListModel  extends BaseModel{
	function GetAllList(){
		$sql = "select * from user_data;";
		$data = $this->_dao->GetRows($sql);
		return $data;
	}
	function GetListCount(){
		$sql = "select count(*) as c from user_data;";
		$data = $this->_dao->GetOneData($sql);
		return $data;
	}
	function delListById($id){
		$sql = "delete from user_data where id = $id;";
		$data = $this->_dao->exec($sql);
		return $data;
	}	
	function GetgiftInfoById($id){
		$sql = "select * from user_data where id = $id;";
		$data = $this->_dao->GetOneRow($sql);
		return $data;
	}	
}