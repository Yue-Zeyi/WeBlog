<?php
class Controller{
	//显示列表
	function IndexAction(){
		$obj_List = ModelFactory::M('ListModel');
		$data1 = $obj_List->GetAllList();	//是一个二维数组
		$data2 = $obj_List->GetListCount();	//是一个数字
		include './Application/Views/View-index.html';
	}
	//删除指定信息
	function DelAction(){
		$id = $_GET['id'];
		$obj = ModelFactory::M('ListModel');
		$result = $obj->delListById($id);
	    echo "<script>alert('删除成功！')</script>";
		echo "<meta http-equiv='Refresh' content='0;URL=index.php'>";
	}	
	//查看指定详情
	function DetailAction(){
		$id = $_GET['id'];
		$obj = ModelFactory::M('ListModel');
		$data = $obj->GetGiftInfoById($id);
		include './Application/Views/View-GiftInfo.html';
	}
}