CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1,	'test',	'admin',	'202cb962ac59075b964b07152d234b70',	'admin@gmail.com',	1,	'2022-11-30 04:15:49',	0,	'2022-11-30 07:28:45',	1);