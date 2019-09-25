CREATE TABLE IF NOT EXISTS `users2` (
    `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(30) NOT NULL,
    `reg_date` date NOT NULL,
    `password` char(60) NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `email` (`email`)
);