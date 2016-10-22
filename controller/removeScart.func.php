<?php
function removeScart($uid,$pid){
	$sql='delete from scart where uid= '.$uid.' and pid= '.$pid.';';
	$dbLink=connectMysqli();
	$result=$dbLink->query($sql);
	exitSend(SUCCESS);
	
}