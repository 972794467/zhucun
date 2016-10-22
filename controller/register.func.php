<?php
function register($phone,$code,$password){	
	
	$redis=redis();
	if(!$redis->exists($phone)){
		exitSend(VERIFY_CODE_NOT_EXISTS);
	}
	$rcode=$redis->get($phone);
	if($rcode==$code){
		$sql='insert into user(phone,password) values("'.$phone.'","'.$password.'");';
		$dbLink=connectMysqli();
		if(!$result=$dbLink->query($sql)){
			exitSend(DB_INSERT_ERROR);
		}else{
			exitSend(SUCCESS);
		}
	}else{
		exitSend(WRONG_VERIFY_CODE);
	}
return;	
}