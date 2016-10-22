<?php
function login($phone,$password)
{			
	$sql='select * from user where phone = "'.$phone.'";';	
	$dbLink=connectMysqli();
	$result=$dbLink->query($sql);
	$row=$result->fetch_assoc();
	if($row==null){		
		exitSend(NO_USER);
	}	
	$_SESSION['uid']=$row['id'];
	if($row['password']==$password){
		$user=array();
		$user['name']=$row['name'];
		$user['id']=$row['id'];
		$user['avatar']=$row['avatar'];
		$user['type']=$row['type'];
		$user['address']=$row['address'];
		$user['grade']=$row['grade'];
		$user['xp']=$row['xp'];
		$user['c_id']=$row['c_id'];
		exit(json_encode($user));
	}else{
		exitSend(WRONG_PASSWORD);
	}
	$result->free();		
	$dbLink->close();
}
	
	

	
	
	
	
	
	
	
	
	
