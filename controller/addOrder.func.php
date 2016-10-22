<?php
function addOrder($uid,$address,$name,$price,$aprice,$remark,$ctime,$phone,$products){
	$sql='insert into `order` (uid,address,name,price,aprice,remark,ctime,phone) values('.$uid.',"'.$address.'","'.$name.'",'.$price.','.$aprice.',"'.$remark.'",'.$ctime.',"'.$phone.'");';

	$dbLink=connectMysqli();
	if(!$result=$dbLink->query($sql)){
		exitSend(DB_INSERT_ERROR);
	}
	$oid=$dbLink->insert_id;
	foreach( $products as $product){
		$pid=$product['pid'];
		$number=$product['number'];
		$sql='insert into o_products values('.$oid.','.$pid.','.$number.');';
		if(!$oresult=$dbLink->query($sql)){
			//此处应删除刚刚插入的订单及信息
			exitSend(DB_INSERT_ERROR);
		}
				
	}
	print_r(json_encode(array('OID'=>$oid)));

	
}