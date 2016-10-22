<?php
function sendShortMessage($phone){
	
	if(useExist($phone)){
		exitSend(USER_EXISTS);
	}
	$redis=redis();
	if($redis->exists($phone)){
		exitSend(VERIFY_CODE_EXISTS);
	}
	$code=rand(10000,99999);
	$options=array('accountsid'=>MESSAGE_ACCOUNTSID,'token'=>MESSAGE_TOKEN);
	$ucpass = new Ucpaas($options);
	//echo $ucpass->getDevinfo('json');
	$appId = MESSAGE_APPID;
	$templateId = MESSAGE_TEMPLATEID;
	$result=$ucpass->templateSMS($appId,$phone,$templateId,$code);
	$tmp=explode("000000",$result);
	if(count($tmp)<=1){
		exitSend(SEND_MESSAG_EERROR);
	}
	
	$redis->set($phone,$code);
	$redis->EXPIRE($phone,LOSE_TIME);
	exitSend(SUCCESS);				
	
}
//初始化 $options必填
//$ucpass = new Ucpaas($this->options);

//开发者账号信息查询默认为json或xml

//echo $ucpass->getDevinfo('json'); 

//申请client账号
//$appId = "d96b3e38e2c34da69067e69aaa2ed65d";
//$clientType = "0";
//$charge = "0";
//$friendlyName = '';
//$mobile = "18612345678";

//echo $ucpass->applyClient($appId, $clientType, $charge, $friendlyName, $mobile);

//删除client账号
//$appId = "xxxx";
//$clientNumber='xxxxx';

//echo $ucpass->releaseClient($clientNumber,$appId);

//删除client账号
//$appId = "xxxx";
//$start = "0";
//$limit = "100";
//
//echo $ucpass->getClientList($appId,$start,$limit);

//以Client账号方式查询Client信息
//$appId = "xxxx";
//$clientNumber='xxxx';
//
//echo $ucpass->getClientInfo($appId,$clientNumber);
//public function querybyphonenumber(){
////以手机号码方式查询Client信息
//$appId = "d96b3e38e2c34da69067e69aaa2ed65d";
//$mobile = "18291415124";
//
//echo $ucpass->getClientInfoByMobile($appId,$mobile);
//}

//应用话单下载,通过HTTPS POST方式提交请求，云之讯融合通讯开放平台收到请求后，返回应用话单下载地址及文件下载检验码。
//day 代表前一天的数据（从00:00 – 23:59）；week代表前一周的数据(周一 到周日)；month表示上一个月的数据（上个月表示当前月减1，如果今天是4月10号，则查询结果是3月份的数据）
//$appId = "xxxx";
//$date = "day";

//echo $ucpass->getBillList($appId,$date);

//Client充值,通过HTTPS POST方式提交充值请求，云之讯融合通讯开放平台收到请求后，返回Client充值结果。
//$appId = "xxxx";
//$clientNumber='xxxx';
//$clientType = "0";
//$charge = "0";

//echo $ucpass->chargeClient($appId,$clientNumber,$clientType,$charge);

//双向回拨,云之讯融合通讯开放平台收到请求后，将向两个电话终端发起呼叫，双方接通电话后进行通话。
//$appId = "xxxx";
//$fromClient = "xxxx";
//$to = "18612345678";
//$fromSerNum = '';
//$toSerNum = '';

//echo $ucpass->callBack($appId,$fromClient,$to);

//语音验证码,云之讯融合通讯开放平台收到请求后，向对象电话终端发起呼叫，接通电话后将播放指定语音验证码序列
//$appId = "xxxx";
//$verifyCode = "1256";
//$to = "18612345678";

//echo $ucpass->voiceCode($appId,$verifyCode,$to);

//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。