<?php
function addToScart($uid,$pid,$number){
	
	$dbLink=connectMysqli();
	$sql='insert into scart values('.$uid.','.$pid.','.$number.');';
	if(!$dbLink->query($sql)){
		//�������˵�����и���Ʒ��ֱ����������
		$sql='update scart set number=number+'.$number.' where uid='.$uid.';';
		if($dbLink->query($sql)){
			exitSend(SUCCESS);
		}else{
			exitSend(DB_INSERT_ERROR);
		}
	}else{
		exitSend(SUCCESS);
	}
}