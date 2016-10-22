<?php
	if(!defined('ACCESS')){
		exit('leave!');
	}
	
   define ('DEFAULT_CHARSET','utf-8');   
   define ('DATABASE_CONNECT','Mysqli');   //备选    PDO
   define ('DATABASE_HOST','localhost');
   define ('DATABASE_USER','root');
   define ('DATABASE_PASSWORD','');  
   define ('DATABASE_DBNAME','shopdb');
   
   //图片路径
   define ('IMGPATH','http://10.247.87.43/zhucun/img/');
   
   //redis地址
   define ('REDIS_HOST','127.0.0.1');//redis 服务器地址
   define ('REDIS_PORT',6379);            //redis  端口号
   define ('LOSE_TIME',100);              //失效时间
   
   
 
   define ('MESSAGE_ACCOUNTSID','');
   define ('MESSAGE_TOKEN','');
   define ('MESSAGE_APPID','');
   define ('MESSAGE_TEMPLATEID','');
   
   
   
   
   
   define ('SUCCESS','100000');
   define ('CONNECT_DATABASE_ERROR','100001');              
   define ('ACCEPT_JSON_ERROR','100002');
   define ('PARAMETER_FEW','100003');
   define ('DB_INSERT_ERROR','100004');
   define ('NO_USER','100005');
   define ('WRONG_PASSWORD','100006');
   define ('VERIFY_CODE_NOT_EXISTS','100007');
   define ('VERIFY_CODE_EXISTS','100008');
   define ('WRONG_VERIFY_CODE','100009');
   define ('DB_NOT_FIND','100010');
   define ('ACCEPT_FILE_ERROR','100011');
   define ('USER_EXISTS','100012');
   define ('EMAIL_INVALID','100013');
   define ('EMAIL_SEND_ERROR','100014');
   define ('NOT_LOGIN','100015');
   define ('NO_METHOD','100016');
   define ('WRONG_ORDER_STATR','100017');
   define ('SEND_MESSAG_EERROR','100018');
   