INSERT INTO `{c2r-prefix}_modules` (`name`, `folder`, `code`, `sort`) VALUES ("{c2r-mod-name}", "{c2r-mod-folder}", "{c2r-mod-code}", 0);

CREATE TABLE IF NOT EXISTS `{c2r-prefix}_newsletters` (
	`id` int(11) NOT NULL,
    `email` varchar(255) CHARACTER SET utf8 NOT NULL,
    `name` varchar(255) CHARACTER SET utf8 NOT NULL,
    `company` varchar(255) CHARACTER SET utf8 NOT NULL,
    `areas` text CHARACTER SET utf8 NOT NULL,
    `code` text CHARACTER SET utf8 NOT NULL,
    `date` datetime NOT NULL,
    `date_update` datetime NOT NULL,
    `active` tinyint(1) DEFAULT '0'
  PRIMARY KEY (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
