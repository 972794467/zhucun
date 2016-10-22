<?php
function deliveryOrder($oid,$logistics){
	$sql='select state from `order` where id='.$oid.';';
	$dbLink=connectMysqli();
	if($result=$dbLink->query($sql)){
		$row=$result->fetch_assoc();
		if($row['state']!=1){
			exitSend(WRONG_ORDER_STATR);
		}		
	}else{
		exitSend(DB_NOT_FIND);
	}
	
	
	$sql='update `order` set logistics='.$logistics.',state=2  where id='.$oid.';';
	
	if($result=$dbLink->query($sql)){
		exitSend(SUCCESS);
	}else{
		exitSend(DB_NOT_FIND);
	}
	
}