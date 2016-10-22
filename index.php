<?php
//header("Content-Type:text/plain;charset=utf-8");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow_methods:POST,GET");
define('ACCESS','host');             //防止非法访问
session_start();
require('lib/mysqli.func.php');
require('conf/config.php');
require('lib/exitSend.func.php');

if(!isset($_POST['method'])){
$JSON=file_get_contents('php://input');
if(!$JSON){
	exitSend(ACCEPT_JSON_ERROR);
}else{
	$jsonArray=json_decode($JSON,true);
	$method=$jsonArray['method'];
}
}else{
	$method=$_POST['method'];
}


if($method===null){
	var_dump($_POST);
	exitSend(PARAMETER_FEW);	
	
}else if($method=='login'){
	require('controller/login.func.php');
	if(!isset($jsonArray['phone'])||!isset($jsonArray['password'])){
		exitSend(PARAMETER_FEW);
	}
	$phone=$jsonArray['phone'];
	$password=$jsonArray['password'];
	
	login($phone,$password);
	
}else if($method=='reg'){
	require('lib/redis.func.php');
	require('controller/register.func.php');
	
	if(!isset($jsonArray['phone'])||!isset($jsonArray['code'])||!isset($jsonArray['password'])){
		exitSend(PARAMETER_FEW);
	}
	$phone=$jsonArray['phone'];
	$code=$jsonArray['code'];
	$password=$jsonArray['password'];
	
	register($phone,$code,$password);
	
}else if($method=='sendEmail'){
	require('lib/email.class.php');
	require('lib/redis.func.php');
	require('controller/sendEmail.func.php');
	if(!isset($jsonArray['email'])){
		exitSend(PARAMETER_FEW);
	}
	$email=$jsonArray['email'];  
	sendEmail($email);
	
}else if($method=='sendShortMessage'){
	require('lib/Ucpaas.class.php');
	require('lib/redis.func.php');
	require('lib/useExist.func.php');
	require('controller/sendShortMessage.func.php');
	
	if(!isset($jsonArray['phone'])){
		exitSend(PARAMETER_FEW);
	}	
	$phone=$jsonArray['phone'];
	
	sendShortMessage($phone);
	
}else if($method=='uploadProduct'){
	require('lib/receiveImg.func.php');
	require('controller/uploadProduct.func.php');
	
	uploadProduct();
}else if($method=='getAllProducts'){	
	require('controller/getAllProducts.func.php');
	
	getAllProducts();
}else if($method=='getProduct'){
	require('controller/getProduct.func.php');
	
	if(!isset($jsonArray['id'])){
		exitSend(PARAMETER_FEW);
	}
	$id=$jsonArray['id'];
	
	getProduct($id);
}else if($method=='addToScart'){
	require('controller/addToScart.func.php');
	if(!isset($jsonArray['uid'])||!isset($jsonArray['pid'])||!isset($jsonArray['number']))
	{
		exitSend(PARAMETER_FEW);
	}
	$uid=$jsonArray['uid'];
	$pid=$jsonArray['pid'];
	$number=$jsonArray['number'];
	/*if(isset($_SESSION['uid'])){
		exitSend(NOT_LOGIN);
	}*/
	//addToScart($_SESSION['uid'],$pid,$number);
	addToScart($uid,$pid,$number);
}else if($method=='getScart'){
	require('controller/getScart.func.php');
	if(!isset($jsonArray['id'])){
		exitSend(PARAMETER_FEW);
	}
	$id=$jsonArray['id'];
	getScart($id);
}else if($method=='removeScart'){
	require('controller/removeScart.func.php');
	if(!isset($jsonArray['uid'])||!isset($jsonArray['pid'])){
		exitSend(PARAMETER_FEW);
	}
	$uid=$jsonArray['uid'];
	$pid=$jsonArray['pid'];
	removeScart($uid,$pid);	
}else if($method=='addOrder'){
	require('controller/addOrder.func.php');
	$uid=$jsonArray['uid'];
	$address=$jsonArray['address'];
	$name=$jsonArray['name'];
	$price=$jsonArray['price'];
	$remark=$jsonArray['remark'];
	$phone=$jsonArray['phone'];
	$ctime=time();
	$products=$jsonArray['products'];
	if(!isset($jsonArray['uid'])||!isset($jsonArray['address'])||!isset($jsonArray['name'])
		||!isset($jsonArray['price'])||!isset($jsonArray['remark'])||!isset($jsonArray['phone'])||!isset($jsonArray['products'])){
		exitSend(PARAMETER_FEW);
	}
	
	
	addOrder($uid,$address,$name,$price,$price,$remark,$ctime,$phone,$products);
}else if($method=='delProduct'){
	require('controller/delProduct.func.php');
	if(!isset($jsonArray['id'])){
		exitSend(PARAMETER_FEW);
	}
	$pid=$jsonArray['id'];
	delProduct($pid);
}else if($method=='modifyProduct'){
	require('controller/modifyProduct.func.php');
	if(!isset($jsonArray['id'])||!isset($jsonArray['number'])||!isset($jsonArray['price'])
		||!isset($jsonArray['iprice'])||!isset($jsonArray['descrite'])||!isset($jsonArray['classifier'])){
		exitSend(PARAMETER_FEW);
	}
	$pid=$jsonArray['id'];
	$number=$jsonArray['number'];
	$price=$jsonArray['price'];
	$iprice=$jsonArray['iprice'];
	$descrite=$jsonArray['descrite'];
	$classifier=$jsonArray['classifier'];
	//$isShow=$jsonArray['isShow'];
	
	
	
	modifyProduct($pid,$number,$price,$iprice,$descrite,$classifier);
	
}else if($method=='deliveryOrder'){
	require('controller/deliveryOrder.func.php');
	if(!isset($jsonArray['id'])||!isset($jsonArray['logistics'])){
		exitSend(PARAMETER_FEW);
	}
	
	$oid=$jsonArray['id'];
	$logistics=$jsonArray['logistics'];
	deliverOrder($oid,$logistics);	
}else if($method=='getOrder'){
	require('controller/getOrder.func.php');
	if(!isset($jsonArray['id'])){
		exitSend(PARAMETER_FEW);
	}
	$uid=$jsonArray['id'];
	getOrder($uid);
	
}

else{
	exitSend(NO_METHOD);
}
