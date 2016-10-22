<?php 
function sendEmail($email)
{
		
	
	if(preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$email)==false){
		exitSend(EMAIL_INVALID);
	}
	else
	{
		$redis=redis();
		if($redis->exists($email)){
			exitSend(USER_EXISTS);
		}
		$code=rand(10000,99999);
				
		$smtpserver = EMAIL_SERVER;//SMTP服务器
		$smtpserverport =EMAIL_SERVER_PORT;//SMTP服务器端口
		$smtpusermail = EMAIL_HOST;//SMTP服务器的用户邮箱
		$smtpemailto = $email;//发送给谁
		$smtpuser = EMAIL_USER;//SMTP服务器的用户帐号
		$smtppass = EMAIL_PASSWORD;//SMTP服务器的用户密码
		$mailtitle = '验证邮件';//邮件主题
		$mailcontent = '您的验证码为：'.$code;//邮件内容
		$mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件		
		@$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = false;//是否显示发送的调试信息
		@$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

		if($state==""){
		exitSend(EMAIL_SEND_ERROR);
		}		
		
		$redis->set($email,$code);
		$redis->EXPIRE($email,LOSE_TIME);
		exitSend(SUCCESS);				
	}
}	
 