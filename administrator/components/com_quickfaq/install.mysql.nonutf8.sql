CREATE TABLE IF NOT EXISTS `#__quickfaq_categories` (
`id` int(11) unsigned NOT NULL auto_increment,
`parent_id` int(11) unsigned NOT NULL default '0',
`title` varchar(255) NOT NULL default '',
`alias` varchar(255) NOT NULL default '',
`text` mediumtext NOT NULL,
`meta_keywords` text NOT NULL,
`meta_description` text NOT NULL,
`image` text NOT NULL default '',
`published` tinyint(1) NOT NULL default '0',
`checked_out` int(11) unsigned NOT NULL default '0',
`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
`access` int(11) unsigned NOT NULL default '0',
`ordering` int(11) NOT NULL default '0',
PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_tags` (
`id` int(11) NOT NULL auto_increment,
`name` varchar(255) NOT NULL,
`alias` varchar(255) NOT NULL,
`published` tinyint(1) NOT NULL,
`checked_out` int(11) unsigned NOT NULL default '0',
`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_tags_item_relations` (
`tid` int(11) NOT NULL default '0',
`itemid` int(11) NOT NULL default '0',
PRIMARY KEY  (`tid`,`itemid`),
KEY `tid` (`tid`),
KEY `itemid` (`itemid`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_items` (
`id` int(11) NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`alias` varchar(255) NOT NULL default '',
`introtext` mediumtext NOT NULL,
`fulltext` mediumtext NOT NULL,
`plus` int(11) default '0',
`minus` int(11) default '0',
`hits` int(11) unsigned NOT NULL default '0',
`version` int(11) unsigned NOT NULL default '0',
`meta_keywords` text NOT NULL,
`meta_description` text NOT NULL,
`metadata` text NOT NULL,
`created` datetime NOT NULL default '0000-00-00 00:00:00',
`created_by` int(11) unsigned NOT NULL default '0',
`created_by_alias` text NOT NULL,
`modified` datetime NOT NULL default '0000-00-00 00:00:00',
`modified_by` int(11) unsigned NOT NULL default '0',
`attribs` text NOT NULL,
`checked_out` int(11) unsigned NOT NULL default '0',
`checked_out_time` datetime NOT NULL,
`state` tinyint(1) NOT NULL default '0',
`ordering` int(11) default '0',
PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_cats_item_relations` (
`catid` int(11) NOT NULL default '0',
`itemid` int(11) NOT NULL default '0',
`ordering` tinyint(11) NOT NULL,
PRIMARY KEY  (`catid`,`itemid`),
KEY `catid` (`catid`),
KEY `itemid` (`itemid`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_favourites` (
`id` int(11) NOT NULL auto_increment,
`itemid` int(11) NOT NULL default '0',
`userid` int(11) NOT NULL default '0',
PRIMARY KEY  (`id`,`itemid`,`userid`),
KEY `id` (`id`),
KEY `itemid` (`itemid`),
KEY `userid` (`userid`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_files` (
`id` int(11) NOT NULL auto_increment,
`filename` varchar(255) NOT NULL,
`altname` varchar(255) NOT NULL,
`hits` int(11) unsigned NOT NULL default '0',
`uploaded` datetime NOT NULL default '0000-00-00 00:00:00',
`uploaded_by` int(11) unsigned NOT NULL default '0',
`checked_out` int(11) unsigned NOT NULL default '0',
`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__quickfaq_files_item_relations` (
`fileid` int(11) NOT NULL default '0',
`itemid` int(11) NOT NULL default '0',
`ordering` tinyint(11) NOT NULL,
PRIMARY KEY  (`fileid`,`itemid`),
KEY `fileid` (`fileid`),
KEY `itemid` (`itemid`)
) TYPE=MyISAM;