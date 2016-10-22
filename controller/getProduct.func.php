<?php
function getProduct($id){
	
	$sql='select * from products where id= '.$id.';';	
	$dbLink=connectMysqli();
	if(!$result=$dbLink->query($sql)){
		exitSend(DB_NOT_FIND);
	}else{
		$row=$result->fetch_assoc();
		$sql='select * from p_image where pid= '.$id.';';
		$iResult=$dbLink->query($sql);
		$i=0;
		$imgs=array();
		while($irow=$iResult->fetch_assoc())
		{
			$imgs['imgPath'.$i]=IMGPATH.$irow['imgPath'];
			$i++;
		}
		$row['imgGroup']=$imgs;
		print_r(json_encode($row));
	}
}
