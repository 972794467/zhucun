<?php
function getScart($uid){
	$sql='select * from scart where uid= '.$uid.';';
	$dbLink=connectMysqli();
	$result=$dbLink->query($sql);
	$products=array();
	while($row=$result->fetch_assoc()){
		$pid=$row['pid'];
		$sql='select * from products where id= '.$pid.';';
		$pResult=$dbLink->query($sql);
		$pRow=$pResult->fetch_assoc();
		$row['name']=$pRow['name'];
		$row['price']=$pRow['price'];
		$row['iPrice']=$pRow['iPrice'];
		$row['descrite']=$pRow['descrite'];
		$row['classifier']=$pRow['classifier'];
		$sql='select * from p_image where pid= '.$pid.' limit 1 ;';
		$iResult=$dbLink->query($sql);
		$iRow=$iResult->fetch_assoc();
		$row['imgPath']=IMGPATH.$iRow['imgPath'];		
		$products[]=$row;
		$pResult->free();
		$iResult->free();
	}
	$result->free();		
	$dbLink->close();
	exit(json_encode($products));
	
}