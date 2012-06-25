CREATE TABLE IF NOT EXISTS `event`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `url_token` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    `member_id` int(11) NOT NULL,
    `title` int(11) NOT NULL,
    `description` varchar(1024),
    `start_date` varchar(50),
    `end_date` varchar(50),
    `etype` int(1) COMMENT '0:for 1 day, 1:duration',
    `fields` varchar(1024),
    `locations` varchar(1024),
    `target` varchar(1024),
    PRIMARY KEY (`id`),
    UNIQUE KEY `url_token` (`url_token`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `offer`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `url_token` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    `member_id` int(11) NOT NULL,
    `title` int(11) NOT NULL,
    `description` varchar(1024),
    `fields` varchar(1024),
    `locations` varchar(1024),
    `target` varchar(1024),
    PRIMARY KEY (`id`),
    UNIQUE KEY `url_token` (`url_token`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `need`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `url_token` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    `member_id` int(11) NOT NULL,
    `title` int(11) NOT NULL,
    `description` varchar(1024),
    `fields` varchar(1024),
    `locations` varchar(1024),
    `target` varchar(1024),
    PRIMARY KEY (`id`),
    UNIQUE KEY `url_token` (`url_token`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `follow_event`(
    `member_id` int(11) NOT NULL,
    `event_id` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    PRIMARY KEY (`member_id`, `event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `follow_offer`(
    `member_id` int(11) NOT NULL,
    `offer_id` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    PRIMARY KEY (`member_id`, `offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `follow_need`(
    `member_id` int(11) NOT NULL,
    `need_id` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    PRIMARY KEY (`member_id`, `need_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `follow_member`(
    `member_id` int(11) NOT NULL,
    `be_member_id` int(11) NOT NULL,
    `created` int(11) NOT NULL,
    PRIMARY KEY (`member_id`, `be_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
