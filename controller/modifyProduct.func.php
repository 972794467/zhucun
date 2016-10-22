<?php
function modifyProduct($pid,$number,$price,$iprice,$descrite,$classifier){
	$sql='update products set number='.$number.',price='.$price.',iprice='.$iprice.',descrite="'.$descrite.'",classifier='.$classifier.' where id='.$pid.';';
	$dbLink=connectMysqli();
	if($dbLink->query($sql))
	{
		exitSend(SUCCESS);
	}else{
		exitSend(DB_NOT_FIND);
	}
}