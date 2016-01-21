DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL COMMENT 'Primary Key for the Users Table, UUID',
  `email` varchar(255) NOT NULL COMMENT 'Email Address for the User',
  `password` varchar(255) NOT NULL COMMENT 'Hashed Password',
  `firstname` varchar(255) NOT NULL COMMENT 'User''s given name.',
  `lastname` varchar(255) NOT NULL COMMENT 'User''s family name.',
  `role` varchar(50) NOT NULL COMMENT 'ENUM mocked field. See User::getList() for options.',
  `is_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Bool controlling whether login is allowed or not.',
  `created` datetime DEFAULT NULL COMMENT 'Created datetime',
  `creator_id` varchar(36) DEFAULT NULL COMMENT 'ID of User who created row',
  `modified` datetime DEFAULT NULL COMMENT 'Modified datetime',
  `modifier_id` varchar(36) DEFAULT NULL COMMENT 'ID of User who modified row',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `role`, `is_active`, `created`, `creator_id`, `modified`, `modifier_id`)
VALUES
	('08148fbc-32ba-11e4-9e39-080027506c76','testing@localhost.com','$2a$10$sjaVf5UXC2sDgutoZ8bAjezChMvq0I8uQdaEN5evUGWW.WLfWbFES','Testing','Localhost','user',1,'2015-06-30 17:07:35','799763fd-32bc-11e4-9e39-080027506c76','2015-06-30 17:07:35','799763fd-32bc-11e4-9e39-080027506c76'),
	('54108b70-a178-4590-9df4-1a900a00020f','tester@localhost.com','$2a$10$sjaVf5UXC2sDgutoZ8bAjezChMvq0I8uQdaEN5evUGWW.WLfWbFES','Test','Localhost','user',0,'2015-06-30 17:07:35','54108b70-5e58-42dc-b384-1a900a00020f','2014-09-10 17:33:36',NULL),
	('799763fd-32bc-11e4-9e39-080027506c76','admin@localhost.com','$2a$10$sjaVf5UXC2sDgutoZ8bAjezChMvq0I8uQdaEN5evUGWW.WLfWbFES','Admin','Localhost','admin',1,'2015-06-30 17:07:35','799763fd-32bc-11e4-9e39-080027506c76','2015-06-30 17:07:35','799763fd-32bc-11e4-9e39-080027506c76');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
