<?php
$message_title = $_POST["message_title"];
$message_url = $_POST["message_url"];
$message_logo = $_POST["message_logo"];
$message_email = $_POST["message_email"];
$tm = date('Y-m-d H:i:s',time()); 

$conn = new mysqli("localhost", "weblog", "weblog", "weblog");

if($conn->connect_error){
	die("连接失败:" . $conn->connect_error);
}
if(empty($_POST['message_title'])){
return false;
}
 else{
$sql = "INSERT INTO user_data(message_title,message_url,message_logo,message_email,times) VALUES('$message_title','$message_url','$message_logo','$message_email','$tm')";
 }
$result = mysqli_query($conn, $sql);
if(!$result){
	echo("<script>alert('提交失败，服务器出现故障，请联系客服处理！');history.go(-1)</script>");
}else{
	echo("<script>alert('你的博客信息已提交成功，请耐心等待审核！');history.go(-1)</script>");
}
@ mysqli_free_result($result);
mysqli_close($conn);
?>