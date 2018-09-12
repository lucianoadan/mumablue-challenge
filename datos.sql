SET FOREIGN_KEY_CHECKS=0;

INSERT INTO `address` (`id`, `company_name`, `firstname`, `lastname`, `address`, `address2`, `city`, `zip`, `state`, `country_id`, `email`, `phone`)
VALUES
	(282,'Sergio López Rico','Sergio','López Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','628178737'),
	(283,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','62817837'),
	(284,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','523432'),
	(285,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','62323'),
	(286,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','5232'),
	(287,'Sergio López Rico','Sergio','Rico','C/ Milan 31 9ºD','','Torrejon de Ardoz','28850','Madrid',1,'sergio.lopezr@edu.uah.es','5232');

INSERT INTO `country` (`id`, `code`, `name`, `invoice`, `available_shipping`)
VALUES
	(1,'ES','España',0,1),
	(2,'UK','Reino Unido',0,1),
	(3,'PT','Portugal',0,1),
	(4,'FR','Francia',0,1),
	(5,'DE','Alemania',0,1),
	(6,'IT','Italia',0,1),
	(7,'DK','Dinamarca',0,1),
	(8,'IE','Irlanda',0,1),
	(9,'NL','Holanda',0,1),
	(10,'AT','Austria',0,1),
	(11,'BE','Bélgica',0,1),
	(12,'US','Estados Unidos',0,1),
	(13,'CA','Canadá',0,1),
	(14,'PR','Puerto Rico',1,1),
	(15,'AU','Australia',1,1),
	(16,'LU','Luxemburgo',0,1),
	(17,'SG','Singapur',1,1),
	(18,'NZ','Nueva Zelanda',1,1);

INSERT INTO `migration_versions` (`version`)
VALUES
	('20180905192459'),
	('20180905193128'),
	('20180905193812'),
	('20180906203116'),
	('20180906203214'),
	('20180906220133'),
	('20180906222514'),
	('20180907091652');

INSERT INTO `qaquestion` (`id`, `question`, `enable_comment`, `enable_rating`)
VALUES
	(1,'Satisfacción con fecha de entrega',0,1),
	(2,'¿Hubo algún problema en la entrega?',1,0),
	(3,'¿Alguna sugerencia?',1,0);


INSERT INTO `qareview` (`id`, `created_at`, `shipment_id`)
VALUES
	(26,'2018-09-07 12:53:32',32),
	(27,'2018-09-10 07:30:40',31);

INSERT INTO `qareview_answer` (`id`, `review_id`, `question_id`, `rating`, `comment`)
VALUES
	(7,26,1,4,NULL),
	(8,26,2,NULL,'Ninguno'),
	(9,26,3,NULL,'Todo correcto'),
	(10,27,1,4,NULL),
	(11,27,2,NULL,'Ninguno'),
	(12,27,3,NULL,'Tardad menos');


INSERT INTO `shipment` (`id`, `order_ref`, `tracking_num`, `label_path`, `ship_to_addr_id`, `delivery_instructions`, `created_at`, `est_delivery_date`)
VALUES
	(30,'P0001','D4aB2Uhuvj','fake_label.jpg',283,'','2018-09-07 12:48:53','2018-09-13 12:52:47'),
	(31,'P002','EadLzp26Zk','fake_label.jpg',284,'','2018-09-07 12:49:54','2018-09-14 12:49:54'),
	(32,'P0003','njFePQgygr','fake_label.jpg',285,'','2018-09-07 12:51:24','2018-09-09 12:52:48'),
	(33,'21313a','HXxX8LLiHy','fake_label.jpg',286,'','2018-09-12 11:57:00','2018-09-13 11:57:00'),
	(34,'21313a1','FzXRAIEaOq','fake_label.jpg',287,'','2018-09-12 11:57:32','2018-09-18 11:57:32');


INSERT INTO `status` (`id`, `status_group_id`, `code`, `name`)
VALUES
	(7,5,'000','Status Not Available'),
	(8,3,'003','Order Processed: Ready for UPS'),
	(9,2,'005','In Transit'),
	(10,2,'006','On Vehicle for Delivery'),
	(11,2,'007','Shipment Information Voided'),
	(12,2,'010','In Transit: On Time'),
	(13,7,'011','Delivered'),
	(14,3,'012','Clearance in Progress'),
	(15,5,'013','Exception'),
	(16,2,'014','Clearance Completed'),
	(17,5,'016','Held in Warehouse'),
	(18,5,'017','Held for Customer Pickup'),
	(19,5,'018','Delivery Change Requested: Hold for Pickup'),
	(20,5,'019','Held for Future Delivery'),
	(21,5,'020','Held for Future Delivery Requested'),
	(22,2,'021','On Vehicle for Delivery Today'),
	(23,5,'022','First Attempt Made'),
	(24,5,'023','Second Attempt Made'),
	(25,5,'024','Final Attempt Made'),
	(26,5,'025','Transferred to Local Post Office for Delivery'),
	(27,5,'026','Delivered by Local Post Office'),
	(28,5,'027','Delivery Address Change Requested'),
	(29,5,'028','Delivery Address Changed'),
	(30,5,'029','Exception: Action Required'),
	(31,5,'030','Local Post Office Exception'),
	(32,5,'032','Adverse Weather May Cause Delay'),
	(33,6,'033','Return to Sender Requested'),
	(34,6,'034','Returned to Sender'),
	(35,6,'035','Returning to Sender'),
	(36,6,'036','Returning to Sender: In Transit'),
	(37,6,'037','Returning to Sender: On Vehicle for Delivery'),
	(38,7,'038','Picked Up'),
	(39,2,'039','In Transit by Post Office'),
	(40,5,'040','Delivered to UPS Access Point Awaiting Customer Pickup'),
	(41,5,'041','Service Upgrade Requested'),
	(42,5,'042','Service Upgraded'),
	(43,NULL,'043','Voided Pickup'),
	(44,2,'044','In Transit to UPS'),
	(45,3,'045','Order Processed: In Transit to UPS'),
	(46,5,'046','Delay'),
	(47,5,'047','Delay'),
	(48,5,'048','Delay'),
	(49,5,'049','Delay: Action Required'),
	(50,5,'050','Address Information Required'),
	(51,5,'051','Delay: Emergency Situation or Severe Weather'),
	(52,5,'052','Delay: Severe Weather'),
	(53,5,'053','Delay: Severe Weather, Recovery in Progress'),
	(54,5,'054','Delivery Change Requested'),
	(55,5,'055','Rescheduled Delivery'),
	(56,5,'056','Service Upgrade Requested'),
	(57,2,'057','In Transit to a UPS Access Point'),
	(58,5,'058','Clearance Information Required'),
	(59,5,'059','Damage Reported'),
	(60,5,'060','Delivery Attempted'),
	(61,5,'061','Delivery Attempted: Adult Signature Required'),
	(62,5,'062','Delivery Attempted: Funds Required'),
	(63,7,'063','Delivery Change Completed'),
	(64,5,'064','Delivery Refused'),
	(65,5,'065','Pickup Attempted'),
	(66,5,'066','Post Office Delivery Attempted'),
	(67,6,'067','Returned to Sender by Post Office'),
	(68,6,'068','Sent to Lost and Found'),
	(69,5,'069','Package Not Claimed'),
	(70,6,'068','Sent to Lost and Found '),
	(71,5,'069','Package Not Claimed ');

INSERT INTO `status_group` (`id`, `code`, `name`, `color`, `icon`)
VALUES
	(2,'transit','En tránsito','','fa-truck'),
	(3,'process','En proceso','','fa-tasks'),
	(5,'alert','Alerta','danger','fa-exclamation-triangle'),
	(6,'returned','Devuelto','','fa-undo'),
	(7,'delivered','Entregado','success','fa-check');


INSERT INTO `status_update` (`id`, `status_id`, `shipment_id`, `created_at`)
VALUES
	(219,21,30,'2018-09-07 12:48:53'),
	(220,13,31,'2018-09-07 12:49:54'),
	(221,14,32,'2018-09-07 12:51:24'),
	(222,60,30,'2018-09-07 12:52:47'),
	(223,64,32,'2018-09-07 12:52:48'),
	(224,22,33,'2018-09-12 11:57:00'),
	(225,31,34,'2018-09-12 11:57:32');

SET FOREIGN_KEY_CHECKS=1;