<?php
function getOrder($uid){
	$dbLink=connectMysqli();
	$sql='select * from `order` where uid='.$uid.';';
	
	if(!$result=$dbLink->query($sql)){
		exitSend(DB_NOT_FIND);
	}
	
	$orders=array();
	while($order=$result->fetch_assoc()){
		
		$oid=$order['id'];
	
		$sql='select * from o_products where oid = '.$oid.';';

	if(!$oResult=$dbLink->query($sql)){
		exitSend(DB_NOT_FIND);
	}
	$products=array();
	while($prow=$oResult->fetch_assoc()){
		$pid=$prow['pid'];
		$sql='select name,price from products where id='.$pid.';';
		if(!$pResult=$dbLink->query($sql)){
		    exitSend(DB_NOT_FIND);
		}
		while($prow=$pResult->fetch_assoc()){
		$product['pid']=$pid;
		$product['name']=$prow['name'];
		$product['price']=$prow['price'];
		
		
		$sql='select imgPath from p_image where pid='.$pid.' limit 1;';
		if(!$iResult=$dbLink->query($sql)){
		    exitSend(DB_NOT_FIND);
		}
		
			$pathrow=$iResult->fetch_assoc();
			if($pathrow['imgPath']!=null){
				$product['imgPath']= IMGPATH.$pathrow['imgPath'];
			}
			}
			$products[]=$product;
	}
		$order['products']	=$products;
		$orders[]=$order;
	}
    print_r(json_encode($orders));
	
}