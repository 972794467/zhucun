
-- 以下在创建数据库或重置数据库时使用，会删除表中数据，慎用
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
-- 村子表   
/*
地址JSON key:
省 pro
市 city
县 county
*/
-- 需要mysql5.7以上才能支持JSON
-- 图片url存储需要约定好格式，以便解析         
CREATE TABLE `cottage` (
`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`address` VARCHAR(50) NOT NULL,
`name` CHAR(20) NOT NULL,
-- 介绍
`synopsis` TEXT NOT NULL,
-- 人口
`polution` INT UNSIGNED NOT NULL,
`img_url` TEXT,
`city` char(20) NOT NULL,
-- 等级
`grade` TINYINT UNSIGNED NOT NULL
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- 商家表
CREATE TABLE `service` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- 村子id
`cid` TINYINT UNSIGNED NOT NULL,
-- 店主id
`uid` INT UNSIGNED NOT NULL,
`describe` TEXT,
`price` INT UNSIGNED NOT NULL,
`number` INT UNSIGNED NOT NULL,
`type` TINYINT UNSIGNED NOT NULL  
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*
用户类型
0:普通用户
1:农户
2:管理员
类型为农户时，需要 c_id 来标识所属的村
*/
CREATE TABLE `user` (
`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- 微信号
`wid` VARCHAR(50) ,
-- 用户类型
`type` TINYINT UNSIGNED NOT NULL DEFAULT 0,
`phone` CHAR(12) NOT NULL UNIQUE,
`email` CHAR(30) ,
`name` CHAR(30) ,
-- 身份证
`card_id` CHAR(19) ,
-- 头像 url
`avatar` VARCHAR(50) ,
`password` CHAR(32) NOT NULL,
-- 默认收货地址
`address` VARCHAR(50) ,
`grade` TINYINT UNSIGNED NOT NULL DEFAULT 1,
-- 经验值
`xp` INT UNSIGNED NOT NULL DEFAULT 0,
-- 所属村，只有村民才可定义此字段
`cid` TINYINT UNSIGNED 
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

 

/*
这两个表暂不使用
-- 村舍管理权限设计            
CREATE TABLE `permission` (
`id` INT NOT NULL AUTO_INCREMENT,
`user_id` VARCHAR(20) NOT NULL,
`cottage_id` VARCHAR(100) NOT NULL,
`permission` JSON NOT NULL 
PRIMARY KEY (id)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


		 
--邀请码             
CREATE TABLE `c_code` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
`role` TEXT NOT NULL,
timestamp  TIME NOT NULL,
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

*/          


-- 商品表

CREATE TABLE `products`(
`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- 上传者id
`uid` INT UNSIGNED NOT NULL,
`name` VARCHAR(50) NOT NULL,
-- 商品货号
`code` CHAR(30) UNIQUE,
-- 商品存货数量
`number` INT UNSIGNED DEFAULT "0",
-- 商品目前实际价格
`price` DECIMAL(10,2) NOT NULL,
-- 商品市场价格
`iPrice` DECIMAL(10,2) ,
-- 商品描述
`descrite` TEXT,
-- 销量
`sales` INT UNSIGNED DEFAULT 0,
-- 商品量词
`classifier` char(6),
-- 商品上架时间
`addTime` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
-- 商品是否上架 0：下架 1：上架
`isShow` TINYINT(1) DEFAULT 1
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 商品相册表
CREATE TABLE `p_image`(
-- 商品id
`pid`  INT UNSIGNED NOT NULL,
-- 图片路径
`imgPath` VARCHAR(50),
INDEX(`pid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- 商品分类表  
-- 多对多的关系
CREATE TABLE `p_species`(
-- 商品id
`pid`  INT UNSIGNED,
-- 分类id
`sid` SMALLINT UNSIGNED,
UNIQUE(`pid`,`sid`),
INDEX(`pid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 分类表             

CREATE TABLE `species`(
`id` SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`name` CHAR(20) UNIQUE
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- 订单表
CREATE TABLE `order` (
`id` INT UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
-- 下单实际支付价格 （含优惠）
`price` DECIMAL(10,2) NOT NULL,
`name` char(20),
`payCode` CHAR(30),
-- 原价格
`aprice` DECIMAL(10,2) ,
-- 订单创建时间
`ctime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
-- 订单支付时间
`ptime` TIMESTAMP,
`phone` char(20),
/*订单状态  
0:下单未支付 
1：下单已支付，未到货
2: 已发货
3：已到货确认，订单完成  未评价
4：已评价，由2得来
5：订单未支付，取消 
6：订单已支付，取消 
7：待补充
*/
`state` TINYINT UNSIGNED NOT NULL DEFAULT '0',

-- 购买者id
`uid`  INT UNSIGNED NOT NULL,
-- 收货地址
`address`  VARCHAR(50) NOT NULL,
-- 订单备注
`remark` VARCHAR(50),
-- 物流单号
`logistics` char(20) 
)ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8;

-- 订单货物表
 CREATE TABLE `o_products` (
 -- 订单id
`oid` INT UNSIGNED NOT NULL,
-- 商品id
`pid` INT UNSIGNED NOT NULL,
-- 购买该商品数量
`pnumber` INT UNSIGNED NOT NULL

)ENGINE=InnoDB  DEFAULT CHARSET=utf8; 

  
-- 评价表 
CREATE TABLE `appraisal` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- 评论
`comment` VARCHAR(200) NOT NULL DEFAULT "用户未作评价。",
-- 打分星级
`grade` TINYINT UNSIGNED NOT NULL,
-- 订单id
`oid` INT UNSIGNED NOT NULL,
-- 评价人id
`uid`  INT UNSIGNED NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 
 
-- 购物车     
-- 每名用户添加一种商品到购物车，此表就增加一条记录，也就是多个用户对应多个商品 
-- 添加相同商品时，只增加数量
CREATE TABLE `scart` (
-- 用户id 
`uid` INT UNSIGNED NOT NULL,
-- 商品id
`pid` INT UNSIGNED NOT NULL,
-- 商品数量
`number` INT UNSIGNED NOT NULL,
UNIQUE(`uid`,`pid`),
INDEX(`uid`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;






             
             

             
