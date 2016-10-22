
-- �����ڴ������ݿ���������ݿ�ʱʹ�ã���ɾ���������ݣ�����
CREATE DATABASE  IF NOT EXISTS `shopdb`;
DROP TABLE IF EXISTS `user`;    
DROP TABLE IF EXISTS `cottage`;   
DROP TABLE IF EXISTS `products`; 
DROP TABLE IF EXISTS `species`; 
DROP TABLE IF EXISTS `scart`; 
DROP TABLE IF EXISTS `order`; 
DROP TABLE IF EXISTS `appraisal`; 
DROP TABLE IF EXISTS `service`; 
DROP TABLE IF EXISTS `permission`; 
DROP TABLE IF EXISTS `c_code`; 	
DROP TABLE IF EXISTS `p_species`;
DROP TABLE IF EXISTS `o_products`;

USE `shopdb`;
-- ���ӱ�   
/*
��ַJSON key:
ʡ pro
�� city
�� county
*/
-- ��Ҫmysql5.7���ϲ���֧��JSON
-- ͼƬurl�洢��ҪԼ���ø�ʽ���Ա����         
CREATE TABLE `cottage` (
`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`address` VARCHAR(50) NOT NULL,
`name` CHAR(20) NOT NULL,
-- ����
`synopsis` TEXT NOT NULL,
-- �˿�
`polution` INT UNSIGNED NOT NULL,
`img_url` TEXT,
`city` char(20) NOT NULL,
-- �ȼ�
`grade` TINYINT UNSIGNED NOT NULL
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- �̼ұ�
CREATE TABLE `service` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- ����id
`cid` TINYINT UNSIGNED NOT NULL,
-- ����id
`uid` INT UNSIGNED NOT NULL,
`describe` TEXT,
`price` INT UNSIGNED NOT NULL,
`number` INT UNSIGNED NOT NULL,
`type` TINYINT UNSIGNED NOT NULL  
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*
�û�����
0:��ͨ�û�
1:ũ��
2:����Ա
����Ϊũ��ʱ����Ҫ c_id ����ʶ�����Ĵ�
*/
CREATE TABLE `user` (
`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- ΢�ź�
`wid` VARCHAR(50) ,
-- �û�����
`type` TINYINT UNSIGNED NOT NULL DEFAULT 0,
`phone` CHAR(12) NOT NULL UNIQUE,
`email` CHAR(30) ,
`name` CHAR(30) ,
-- ���֤
`card_id` CHAR(19) ,
-- ͷ�� url
`avatar` VARCHAR(50) ,
`password` CHAR(32) NOT NULL,
-- Ĭ���ջ���ַ
`address` VARCHAR(50) ,
`grade` TINYINT UNSIGNED NOT NULL DEFAULT 1,
-- ����ֵ
`xp` INT UNSIGNED NOT NULL DEFAULT 0,
-- �����壬ֻ�д���ſɶ�����ֶ�
`cid` TINYINT UNSIGNED 
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

 

/*
���������ݲ�ʹ��
-- �������Ȩ�����            
CREATE TABLE `permission` (
`id` INT NOT NULL AUTO_INCREMENT,
`user_id` VARCHAR(20) NOT NULL,
`cottage_id` VARCHAR(100) NOT NULL,
`permission` JSON NOT NULL 
PRIMARY KEY (id)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


		 
--������             
CREATE TABLE `c_code` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`role` TEXT NOT NULL,
timestamp  TIME NOT NULL,
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

*/          


-- ��Ʒ��

CREATE TABLE `products`(
`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- �ϴ���id
`uid` INT UNSIGNED NOT NULL,
`name` VARCHAR(50) NOT NULL,
-- ��Ʒ����
`code` CHAR(30) UNIQUE,
-- ��Ʒ�������
`number` INT UNSIGNED DEFAULT "0",
-- ��ƷĿǰʵ�ʼ۸�
`price` DECIMAL(10,2) NOT NULL,
-- ��Ʒ�г��۸�
`iPrice` DECIMAL(10,2) ,
-- ��Ʒ����
`descrite` TEXT,
-- ����
`sales` INT UNSIGNED DEFAULT 0,
-- ��Ʒ����
`classifier` char(6),
-- ��Ʒ�ϼ�ʱ��
`addTime` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
-- ��Ʒ�Ƿ��ϼ� 0���¼� 1���ϼ�
`isShow` TINYINT(1) DEFAULT 1
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ��Ʒ����
CREATE TABLE `p_image`(
-- ��Ʒid
`pid`  INT UNSIGNED NOT NULL,
-- ͼƬ·��
`imgPath` VARCHAR(50),
INDEX(`pid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- ��Ʒ�����  
-- ��Զ�Ĺ�ϵ
CREATE TABLE `p_species`(
-- ��Ʒid
`pid`  INT UNSIGNED,
-- ����id
`sid` SMALLINT UNSIGNED,
UNIQUE(`pid`,`sid`),
INDEX(`pid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- �����             

CREATE TABLE `species`(
`id` SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`name` CHAR(20) UNIQUE
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ������
CREATE TABLE `order` (
`id` INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
-- �µ�ʵ��֧���۸� �����Żݣ�
`price` DECIMAL(10,2) NOT NULL,
`name` char(20),
`payCode` CHAR(30),
-- ԭ�۸�
`aprice` DECIMAL(10,2) ,
-- ��������ʱ��
`ctime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
-- ����֧��ʱ��
`ptime` TIMESTAMP,
`phone` char(20),
/*����״̬  
0:�µ�δ֧�� 
1���µ���֧����δ����
2: �ѷ���
3���ѵ���ȷ�ϣ��������  δ����
4�������ۣ���2����
5������δ֧����ȡ�� 
6��������֧����ȡ�� 
7��������
*/
`state` TINYINT UNSIGNED NOT NULL DEFAULT '0',

-- ������id
`uid`  INT UNSIGNED NOT NULL,
-- �ջ���ַ
`address`  VARCHAR(50) NOT NULL,
-- ������ע
`remark` VARCHAR(50),
-- ��������
`logistics` char(20) 
)ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8;

-- ���������
 CREATE TABLE `o_products` (
 -- ����id
`oid` INT UNSIGNED NOT NULL,
-- ��Ʒid
`pid` INT UNSIGNED NOT NULL,
-- �������Ʒ����
`pnumber` INT UNSIGNED NOT NULL

)ENGINE=InnoDB  DEFAULT CHARSET=utf8; 

  
-- ���۱� 
CREATE TABLE `appraisal` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- ����
`comment` VARCHAR(200) NOT NULL DEFAULT "�û�δ�����ۡ�",
-- ����Ǽ�
`grade` TINYINT UNSIGNED NOT NULL,
-- ����id
`oid` INT UNSIGNED NOT NULL,
-- ������id
`uid`  INT UNSIGNED NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 
 
-- ���ﳵ     
-- ÿ���û����һ����Ʒ�����ﳵ���˱������һ����¼��Ҳ���Ƕ���û���Ӧ�����Ʒ 
-- �����ͬ��Ʒʱ��ֻ��������
CREATE TABLE `scart` (
-- �û�id 
`uid` INT UNSIGNED NOT NULL,
-- ��Ʒid
`pid` INT UNSIGNED NOT NULL,
-- ��Ʒ����
`number` INT UNSIGNED NOT NULL,
UNIQUE(`uid`,`pid`),
INDEX(`uid`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;






             
             

             
