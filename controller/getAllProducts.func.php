<?php
function getAllProducts(){
	$dbLink=connectMysqli();
	$sql='select id,uid,name,price,iPrice,isShow from products;';
	$result=$dbLink->query($sql);
	$products=array();
	while($row=$result->fetch_assoc()){
		$proId=$row['id'];
		$sql='select imgPath from p_image where pid= '.$proId.' limit 1;';
		$pResult=$dbLink->query($sql);
		$pRow=$pResult->fetch_assoc();
		$imgPath=IMGPATH.$pRow['imgPath'];
		$row['imgPath']=$imgPath;
		$sql='select address from cottage where id =(select c_id from user where id ='.$row['uid'].');';
		$aResult=$dbLink->query($sql);
		$aRow=$aResult->fetch_assoc();
		$address=$aRow['address'];
		$row['address']=$address;	
		$products[]=$row;
	}
	print_r(json_encode($products));
}