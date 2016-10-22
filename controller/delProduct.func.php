<?php
function delRroduct($pid){
	$sql='delete from products where id='.$pid.';';
	$dbLink=connectMysqli();
	if($dbLink->query($sql))
	{
		exitSend(SUCCESS);
	}else{
		exitSend(DB_NOT_FIND);
	}
	
}