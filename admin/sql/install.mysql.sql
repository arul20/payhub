DROP TABLE IF EXISTS `#__payhub_items`;
CREATE TABLE IF NOT EXISTS `#__payhub_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__payhub_klarna_settings`;
CREATE TABLE IF NOT EXISTS `#__payhub_klarna_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` varchar(255) DEFAULT NULL,
  `shared_secret` varchar(255) DEFAULT NULL,
  `country` int(4) DEFAULT NULL,
  `currency` int(4) DEFAULT NULL,
  `language` int(4) DEFAULT NULL,
  `beta_mode` tinyint(1) DEFAULT NULL,
  `ssl_mode` tinyint(1) DEFAULT NULL,
  `logging` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__payhub_fees`;
CREATE TABLE IF NOT EXISTS `#__payhub_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__payhub_transactions`;
CREATE TABLE IF NOT EXISTS `#__payhub_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(40) NOT NULL DEFAULT '',
  `payment_status` varchar(40) NOT NULL DEFAULT '',
  `payment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `first_name` varchar(40) NOT NULL DEFAULT '',
  `last_name` varchar(40) NOT NULL DEFAULT '',
  `payer_email` varchar(60) NOT NULL DEFAULT '',
  `residence_country` varchar(2) NOT NULL DEFAULT '',
  `item_name` varchar(128) NOT NULL DEFAULT '',
  `item_number` int(11) NOT NULL DEFAULT '0',
  `mc_gross` varchar(10) NOT NULL DEFAULT '0',
  `tax` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;