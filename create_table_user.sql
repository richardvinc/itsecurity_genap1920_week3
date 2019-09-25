CREATE TABLE IF NOT EXISTS `users` (
    `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(30) NOT NULL,
    `reg_date` date NOT NULL,
    `salt` char(21) NOT NULL,
    `password` char(60) NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `email` (`email`)
);