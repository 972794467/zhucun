<?php
function uploadProduct(){
	if(!isset($_POST['name'])||!isset($_POST['descrite'])||!isset($_POST['classifier'])
	||!isset($_POST['price'])||!isset($_POST['iPrice'])||!isset($_POST['number'])||!isset($_POST['uid']))
	{
		exitSend(PARAMETER_FEW);
	}
	
		
	$name=$_POST['name'];
	$descrite=$_POST['descrite'];
	$classifier=$_POST['classifier'];
	$price=$_POST['price'];
	$iPrice=$_POST['iPrice'];
	$number=$_POST['number'];
	$uid=$_POST['uid'];	
	$imgPaths=receiveImg();
	if(!is_array($imgPaths)){
		exitSend('FILE ERROR '.$imgPaths);
	}
	
	$dbLink=connectMysqli();
	$sql='insert into products(uid,name,number,price,iPrice,descrite,classifier) 
	values('.$uid.',"'.$name.'",'.$number.','.$price.','.$iPrice.',"'.$descrite.'","'.$classifier.'");';
	$dbLink->query($sql);
	$pid=mysqli_insert_id($dbLink);
	foreach($imgPaths as $imgPath){
		$sql='insert into p_image values('.$pid.',"'.$imgPath.'");';
		$dbLink->query($sql);
	}
	//exitSend(SUCCESS);
	header('Content-Type:text/html;charset=utf-8');
	echo '<script type="text/javascript" charset="utf-8">history.go(-1); alert("上传成功"); </script>';
}