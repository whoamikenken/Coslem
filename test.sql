/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.14-MariaDB : Database - coslem
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`coslem` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `coslem`;

/*Table structure for table `annual` */

DROP TABLE IF EXISTS `annual`;

CREATE TABLE `annual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share` int(11) NOT NULL,
  `loan_interest` varchar(255) DEFAULT NULL,
  `loan_penalty` varchar(255) DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `annual` */

insert  into `annual`(`id`,`share`,`loan_interest`,`loan_penalty`,`from_date`,`to_date`,`created_by`,`status`,`timestamp`) values 
(1,200,'5','20','2022-11-01','2023-01-01',1,'ACTIVE','2021-11-18 15:33:38'),
(4,200,'5','50','2023-05-02','2024-01-01',1,'ACTIVE','2023-05-05 12:18:50');

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values 
('e8qj2qeeunaenh8sg3prmhdhbtavipqg','::1',1683260577,'__ci_last_regenerate|i:1683260577;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('9isqnn6ue15ceivqimhbm558ar3o0cdd','::1',1683260973,'__ci_last_regenerate|i:1683260973;id|s:2:\"12\";name|s:8:\"bert too\";fname|s:4:\"bert\";lname|s:3:\"too\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"21\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"owa@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:4:\"bert\";image_link|N;timestamp|s:19:\"2023-05-05 12:21:24\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('gf0qjesqjjnt002vgjun0slvrskhd9p5','::1',1683261127,'__ci_last_regenerate|i:1683261127;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('hvq21us536iui0h4oijqpfjt8q2uol9o','::1',1683261315,'__ci_last_regenerate|i:1683261315;id|s:2:\"12\";name|s:8:\"bert too\";fname|s:4:\"bert\";lname|s:3:\"too\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"21\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"owa@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:4:\"bert\";image_link|N;timestamp|s:19:\"2023-05-05 12:21:24\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('nu0kismb0rr6ocet09s1550v26me8pto','::1',1683262507,'__ci_last_regenerate|i:1683262507;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('2u91vl26j7dqj3lusgm14rcgl8f7e5nn','::1',1683261976,'__ci_last_regenerate|i:1683261976;'),
('i8ctdi5mc44dvdfc3822o16q6hvi8lq0','::1',1683262444,'__ci_last_regenerate|i:1683262444;id|s:2:\"12\";name|s:8:\"bert too\";fname|s:4:\"bert\";lname|s:3:\"too\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"21\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"owa@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:4:\"bert\";image_link|N;timestamp|s:19:\"2023-05-05 12:21:24\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('7n4mu4mmf9ojdj32um41toaahf3j3un3','::1',1683262808,'__ci_last_regenerate|i:1683262808;id|s:2:\"12\";name|s:8:\"bert too\";fname|s:4:\"bert\";lname|s:3:\"too\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"21\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"owa@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:4:\"bert\";image_link|N;timestamp|s:19:\"2023-05-05 12:21:24\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('l4s14evb0n03srupt8f35973vc1rioq0','::1',1683262832,'__ci_last_regenerate|i:1683262832;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('lbi4bvt26h5hcam9ivoll4f1mulaost3','::1',1683263256,'__ci_last_regenerate|i:1683263256;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('q49affmri9v3ccum8opfi94ah69sok9o','::1',1683264924,'__ci_last_regenerate|i:1683264924;id|s:2:\"12\";name|s:8:\"bert too\";fname|s:4:\"bert\";lname|s:3:\"too\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"21\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"owa@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:4:\"bert\";image_link|N;timestamp|s:19:\"2023-05-05 12:21:24\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('gg1ckvn158g7ciqgl4tsnkpdhlnjo0sg','::1',1683264915,'__ci_last_regenerate|i:1683264915;id|s:1:\"2\";name|s:6:\"tresue\";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:26:\"62 Marulas B Caloocan City\";age|s:2:\"20\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:9:\"treasurer\";username|s:10:\"treasurer1\";image_link|N;timestamp|s:19:\"2021-11-18 03:18:12\";logged_in|b:1;bg|s:4:\"info\";sess_expiration|i:2400;'),
('v9kdo3u3mkaplm2i2rgpvd3mo6js6fog','::1',1683264992,'__ci_last_regenerate|i:1683264992;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('006hgarnslteloj0sbfjetvchklhdpv7','::1',1683263749,'__ci_last_regenerate|i:1683263749;'),
('6hlavtu63vcoj132eiamqk19ndp3en1r','::1',1683264053,'__ci_last_regenerate|i:1683264053;'),
('or2modidplp0qfs6sc8lv5r7o4h34shc','::1',1683264582,'__ci_last_regenerate|i:1683264582;'),
('cqn5btro8dpp8pp9hphevi9oce6ir2k7','::1',1683264893,'__ci_last_regenerate|i:1683264582;'),
('3vmbci3cnj3mk65jsui0f3m2cfkck2hs','::1',1683265066,'__ci_last_regenerate|i:1683264915;id|s:1:\"2\";name|s:6:\"tresue\";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:26:\"62 Marulas B Caloocan City\";age|s:2:\"20\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:9:\"treasurer\";username|s:10:\"treasurer1\";image_link|N;timestamp|s:19:\"2021-11-18 03:18:12\";logged_in|b:1;bg|s:4:\"info\";sess_expiration|i:2400;'),
('4b92n0rml21o2ncgjia0bvouc7f1g4hn','::1',1683265070,'__ci_last_regenerate|i:1683264924;id|s:2:\"12\";name|s:8:\"bert too\";fname|s:4:\"bert\";lname|s:3:\"too\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"21\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"owa@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:4:\"bert\";image_link|N;timestamp|s:19:\"2023-05-05 12:21:24\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('5lh0k7bir92com9r3d88o9op6024ig3u','::1',1683265122,'__ci_last_regenerate|i:1683264992;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('ubspflrp3ldlrn69u8tfj45taf5s84ni','::1',1683507644,'__ci_last_regenerate|i:1683507574;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('o79ds0s754l05r02o1kod66ha3969dr8','::1',1683518997,'__ci_last_regenerate|i:1683518797;'),
('meucjn4d9dkusmoib3o6sv3tin4dsqbh','::1',1683595499,'__ci_last_regenerate|i:1683595499;'),
('hdn5r1i4a1b5bu23nrrt5e82g2i9k13k','::1',1683595993,'__ci_last_regenerate|i:1683595993;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('t4jbsgc6mbngqk99ufqacsosssogqosq','::1',1683596347,'__ci_last_regenerate|i:1683596347;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;'),
('59hd29754pjfqpta6nmaf3lp4nr9homq','::1',1683596153,'__ci_last_regenerate|i:1683596000;id|s:2:\"16\";name|s:7:\"ben rai\";fname|s:3:\"ben\";lname|s:3:\"rai\";password|s:32:\"a40e3d058b5e02870d9badc4e4f2fd84\";address|s:26:\"D15 Blk48 lot12 pandacaqui\";age|s:2:\"33\";contribution|s:3:\"300\";share|s:1:\"0\";email|s:13:\"123@gmail.com\";mobile|s:11:\"09292470145\";gender|s:4:\"Male\";status|s:8:\"Verified\";type|s:6:\"member\";username|s:5:\"rubin\";image_link|N;timestamp|s:19:\"2023-05-09 09:34:09\";logged_in|b:1;bg|s:9:\"secondary\";sess_expiration|i:2400;'),
('t4qs7978ksbmfg733378lugcoohj9grg','::1',1683596428,'__ci_last_regenerate|i:1683596347;id|s:1:\"1\";name|s:6:\"Admin \";fname|N;lname|N;password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09068967203\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;bg|s:4:\"dark\";sess_expiration|i:2400;');

/*Table structure for table `funds` */

DROP TABLE IF EXISTS `funds`;

CREATE TABLE `funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `contribution` int(11) NOT NULL DEFAULT 0,
  `available` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `funds` */

insert  into `funds`(`id`,`user_id`,`balance`,`contribution`,`available`) values 
(5,'5',11000,2100,2300),
(6,'6',500,2000,5500),
(7,'7',1800,900,900),
(8,'10',0,400,1200),
(9,'11',0,300,900),
(10,'12',1300,700,800),
(11,'16',0,300,900);

/*Table structure for table `loan` */

DROP TABLE IF EXISTS `loan`;

CREATE TABLE `loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `monthly` int(11) NOT NULL,
  `months_paid` int(11) NOT NULL,
  `months_period` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `isactive` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `requested_by` int(11) NOT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `remaining_balance` int(11) NOT NULL,
  `total_loan_amount` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `loan` */

insert  into `loan`(`id`,`user_id`,`amount`,`monthly`,`months_paid`,`months_period`,`from_date`,`to_date`,`remarks`,`status`,`isactive`,`requested_by`,`approve_by`,`remaining_balance`,`total_loan_amount`,`interest`,`timestamp`) values 
(14,12,300,63,0,5,'2023-06-01','2023-10-25','mag bayad kana','APPROVED','ACTIVE',1,1,315,315,15,'2023-05-05 13:01:52'),
(15,12,233,49,0,5,'2023-06-01','2023-10-25','pautang lods','PENDING','ACTIVE',1,NULL,245,245,12,'2023-05-08 09:00:33'),
(16,16,200,70,0,3,'2023-06-01','2023-08-25','test','PENDING','ACTIVE',1,NULL,210,210,10,'2023-05-09 09:39:30');

/*Table structure for table `transaction_files` */

DROP TABLE IF EXISTS `transaction_files`;

CREATE TABLE `transaction_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `base_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_link` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaction_files` */

insert  into `transaction_files`(`id`,`base_id`,`user_id`,`file_link`,`file_name`,`file_type`,`timestamp`) values 
(17,54,12,'1.jpg','1.jpg','image/jpeg','2023-05-05 13:36:03'),
(18,55,12,'WWW_YTS_AG.jpg','WWW_YTS_AG.jpg','image/jpeg','2023-05-05 13:37:36');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `base_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `delete` int(11) NOT NULL DEFAULT 0,
  `file_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`user_id`,`base_id`,`amount`,`remarks`,`status`,`type`,`created_by`,`approve_by`,`delete`,`file_id`,`timestamp`) values 
(53,12,NULL,300,'Members Approved Loan','APPROVED','Loan',12,1,0,0,'2023-05-05 13:02:12'),
(54,12,NULL,200,'pautang lods','APPROVED','Contribution',2,NULL,0,17,'2023-05-31 00:00:00'),
(55,12,NULL,200,'pautang lods','APPROVED','Loan',2,NULL,0,18,'2023-05-31 00:00:00'),
(56,12,NULL,123,'pautang lods','PENDING','Loan',1,NULL,0,0,'2023-05-31 00:00:00'),
(57,12,NULL,221,'pautang po lods','PENDING','Contribution',1,NULL,0,0,'2023-05-31 00:00:00'),
(58,16,NULL,300,'Member Contribution','APPROVED','Contribution',16,1,0,0,'2023-05-09 09:35:13'),
(59,16,NULL,200,'mag bayad kana','PENDING','Loan',1,NULL,0,0,'2023-05-31 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `contribution` int(11) NOT NULL DEFAULT 0,
  `share` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `username` varchar(255) NOT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`fname`,`lname`,`password`,`address`,`age`,`contribution`,`share`,`email`,`mobile`,`gender`,`status`,`type`,`username`,`image_link`,`timestamp`) values 
(1,'Admin ',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','71 Dagat-dagatan',18,0,0,'raivenm280@gmail.com','09068967203','Male','Active','admin','admin',NULL,'2021-11-18 03:06:41'),
(2,'tresue',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','62 Marulas B Caloocan City',20,0,0,'raivenm280@gmail.com','09068967203','Male','Verified','treasurer','treasurer1',NULL,'2021-11-18 03:18:12'),
(5,'raiven',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','62 Marulas B Caloocan City',15,2000,10,'raivenm280@gmail.com','09226361316','Male','Verified','member','raivenm','117943099_1088445701557853_3091277158760663503_o2.jpg','2021-11-18 03:48:42'),
(7,'Ruben',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','D15 Blk48 lot12 pandacaqui',43,300,0,'raivenm280@gmail.com','09226361316','Male','Verified','member','ruben',NULL,'2023-02-12 07:07:36'),
(10,'mama',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','D15 Blk48 lot12 pandacaqui',31,400,0,'mama@gmail.com','09226361316','Male','Verified','member','mama',NULL,'2023-02-20 17:27:03'),
(11,'raiven morales','raiven','morales','a40e3d058b5e02870d9badc4e4f2fd84','D15 Blk48 lot12 pandacaqui',21,300,0,'raivenmm280@gmail.com','09068967203','Male','Verified','member','ribin',NULL,'2023-05-04 07:13:11'),
(12,'bert too','bert','too','a40e3d058b5e02870d9badc4e4f2fd84','D15 Blk48 lot12 pandacaqui',21,300,0,'owa@gmail.com','09068967203','Male','Verified','member','bert',NULL,'2023-05-05 12:21:24'),
(15,'jj kk','jj','kk','a40e3d058b5e02870d9badc4e4f2fd84','jaan lang sa tabi',21,300,0,'kk@gmail.com','09068967203','Male','Unverified','member','jj',NULL,'2023-05-05 13:34:19'),
(16,'ben rai','ben','rai','a40e3d058b5e02870d9badc4e4f2fd84','D15 Blk48 lot12 pandacaqui',33,300,0,'123@gmail.com','09292470145','Male','Verified','member','rubin',NULL,'2023-05-09 09:34:09');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
