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