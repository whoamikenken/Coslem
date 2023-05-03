/*
SQLyog Trial v13.1.9 (64 bit)
MySQL - 10.4.27-MariaDB : Database - coslem
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`coslem` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `coslem`;

/*Table structure for table `annual` */

DROP TABLE IF EXISTS `annual`;

CREATE TABLE `annual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `annual` */

insert  into `annual`(`id`,`share`,`from_date`,`to_date`,`created_by`,`status`,`timestamp`) values 
(1,200,'2022-11-01','2023-01-01',1,'ACTIVE','2021-11-18 15:33:38');

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values 
('634d1bef9017bf8b7e670913908cf19410f9b2a7','172.18.0.1',1683090279,'__ci_last_regenerate|i:1683090279;id|s:1:\"1\";name|s:6:\"Admin \";password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09226361316\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;sess_expiration|i:2400;'),
('8ff3863c6c379301932f01d9ef04db555f7175bb','172.18.0.1',1683090912,'__ci_last_regenerate|i:1683090912;id|s:1:\"1\";name|s:6:\"Admin \";password|s:32:\"0cc175b9c0f1b6a831c399e269772661\";address|s:16:\"71 Dagat-dagatan\";age|s:2:\"18\";contribution|s:1:\"0\";share|s:1:\"0\";email|s:20:\"raivenm280@gmail.com\";mobile|s:11:\"09226361316\";gender|s:4:\"Male\";status|s:6:\"Active\";type|s:5:\"admin\";username|s:5:\"admin\";image_link|N;timestamp|s:19:\"2021-11-18 03:06:41\";logged_in|b:1;sess_expiration|i:2400;'),
('9ba172fd7c35ac6d10f92ce6b53b34db3795a8a3','172.18.0.1',1683091332,'__ci_last_regenerate|i:1683091144;');

/*Table structure for table `funds` */

DROP TABLE IF EXISTS `funds`;

CREATE TABLE `funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `contribution` int(11) NOT NULL DEFAULT 0,
  `available` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `funds` */

insert  into `funds`(`id`,`user_id`,`balance`,`contribution`,`available`) values 
(5,'5',11000,2100,2300),
(6,'6',500,2000,5500),
(7,'7',1800,900,900),
(8,'10',0,400,1200);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `loan` */

insert  into `loan`(`id`,`user_id`,`amount`,`monthly`,`months_paid`,`months_period`,`from_date`,`to_date`,`remarks`,`status`,`isactive`,`requested_by`,`approve_by`,`remaining_balance`,`total_loan_amount`,`interest`,`timestamp`) values 
(4,5,6000,1575,0,4,'2022-02-01','2022-04-30','TEST','APPROVED','ACTIVE',1,1,6300,6300,300,'2022-01-13 11:35:18'),
(5,6,500,131,0,4,'2023-03-01','2023-06-03','pautang po lods','APPROVED','ACTIVE',6,1,525,525,25,'2023-02-08 08:55:29'),
(6,5,5000,583,0,9,'2023-03-01','2023-11-03','test','APPROVED','ACTIVE',5,1,5250,5250,250,'2023-02-08 09:01:03'),
(7,7,800,84,0,10,'2023-03-01','2023-12-03','pautang po lods','APPROVED','ACTIVE',7,1,840,840,40,'2023-02-12 07:11:15'),
(8,7,100,15,0,7,'2023-03-01','2023-09-03','test','DISAPPROVED','ACTIVE',7,NULL,105,105,5,'2023-02-12 23:30:23'),
(9,7,100,12,0,9,'2023-03-01','2023-11-03','pautang po lods','APPROVED','ACTIVE',7,1,105,105,5,'2023-02-12 23:31:24'),
(10,7,900,105,0,9,'2023-03-01','2023-11-03','pautang po lods','APPROVED','ACTIVE',7,1,945,945,45,'2023-02-12 23:58:04'),
(11,10,1000,210,0,5,'2023-03-01','2023-07-03','pautang lods','PENDING','ACTIVE',10,NULL,1050,1050,50,'2023-02-20 20:26:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaction_files` */

insert  into `transaction_files`(`id`,`base_id`,`user_id`,`file_link`,`file_name`,`file_type`,`timestamp`) values 
(4,14,5,'117943099_1088445701557853_3091277158760663503_o1.jpg','117943099_1088445701557853_3091277158760663503_o.jpg','image/jpeg','2022-01-13 11:10:35'),
(5,15,5,'121660512_5251411661539240_3748944721897136565_o.jpg','121660512_5251411661539240_3748944721897136565_o.jpg','image/jpeg','2022-01-13 11:18:19'),
(6,12,5,'121648285_5251411688205904_378163402100567756_o.jpg','121648285_5251411688205904_378163402100567756_o.jpg','image/jpeg','2022-01-13 11:18:23'),
(7,35,7,'1.jpg','1.jpg','image/jpeg','2023-02-12 23:25:56'),
(8,38,7,'324384169_425979999662085_5781915157834793723_n.jpg','324384169_425979999662085_5781915157834793723_n.jpg','image/jpeg','2023-02-12 23:36:26'),
(9,39,7,'11.jpg','1.jpg','image/jpeg','2023-02-12 23:40:39'),
(10,36,7,'12.jpg','1.jpg','image/jpeg','2023-02-12 23:55:36'),
(11,42,7,'13.jpg','1.jpg','image/jpeg','2023-02-13 00:05:08'),
(12,43,7,'14.jpg','1.jpg','image/jpeg','2023-02-13 00:08:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`user_id`,`base_id`,`amount`,`remarks`,`status`,`type`,`created_by`,`approve_by`,`delete`,`file_id`,`timestamp`) values 
(35,7,NULL,1000,'test','APPROVED','Loan',1,NULL,0,7,'2023-02-01 00:00:00'),
(36,7,NULL,100,'Members Approved Loan','APPROVED','Loan',7,1,0,10,'2023-02-12 23:31:43'),
(37,5,NULL,100,'mag bayad kana','APPROVED','Contribution',1,NULL,0,0,'2023-04-01 00:00:00'),
(38,7,NULL,100,'mag bayad kana','APPROVED','Contribution',1,NULL,0,8,'2023-03-01 00:00:00'),
(39,7,NULL,500,'test','APPROVED','Contribution',1,NULL,0,9,'2023-03-02 00:00:00'),
(40,5,NULL,500,'mag bayad kana','APPROVED','Contribution',1,1,0,0,'2023-03-01 00:00:00'),
(41,7,NULL,900,'Members Approved Loan','APPROVED','Loan',7,1,0,0,'2023-02-12 23:58:46'),
(42,7,NULL,1000,'magbayad kana','APPROVED','Loan',1,NULL,0,11,'2023-04-05 00:00:00'),
(43,7,NULL,1000,'magbayad kana','APPROVED','Loan',1,NULL,0,12,'2023-05-01 00:00:00'),
(44,10,NULL,400,'Member Contribution','APPROVED','Contribution',10,1,0,0,'2023-02-20 17:27:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`fname`,`lname`,`password`,`address`,`age`,`contribution`,`share`,`email`,`mobile`,`gender`,`status`,`type`,`username`,`image_link`,`timestamp`) values 
(1,'Admin ',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','71 Dagat-dagatan',18,0,0,'raivenm280@gmail.com','09226361316','Male','Active','admin','admin',NULL,'2021-11-18 03:06:41'),
(2,'tresue',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','62 Marulas B Caloocan City',20,0,0,'raivenm280@gmail.com','09226361316','Male','Verified','treasurer','treasurer1',NULL,'2021-11-18 03:18:12'),
(5,'raiven',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','62 Marulas B Caloocan City',15,2000,10,'raivenm280@gmail.com','09226361316','Male','Verified','member','raivenm','117943099_1088445701557853_3091277158760663503_o2.jpg','2021-11-18 03:48:42'),
(7,'Ruben',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','D15 Blk48 lot12 pandacaqui',43,300,0,'raivenm280@gmail.com','09226361316','Male','Verified','member','ruben',NULL,'2023-02-12 07:07:36'),
(10,'mama',NULL,NULL,'0cc175b9c0f1b6a831c399e269772661','D15 Blk48 lot12 pandacaqui',31,400,0,'mama@gmail.com','09226361316','Male','Verified','member','mama',NULL,'2023-02-20 17:27:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
