
#
# Table structure for table `faq_categories`
#

CREATE TABLE `xoopsfaq_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) NOT NULL DEFAULT '',
  `category_order` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `category_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 ;


#
# Table structure for table `faq_contents`
#

CREATE TABLE `xoopsfaq_contents` (
  `contents_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contents_cid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `contents_title` varchar(255) NOT NULL DEFAULT '',
  `contents_contents` text NOT NULL,
  `contents_publish` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contents_weight` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `contents_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `dohtml` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `doxcode` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `dosmiley` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `doimage` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `dobr` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `contents_seealso1` varchar(255) NOT NULL,
  `contents_libseealso1` varchar(50) NOT NULL,
  `contents_seealso2` varchar(255) NOT NULL,
  `contents_libseealso2` varchar(50) NOT NULL,
  `contents_seealso3` varchar(255) NOT NULL,
  `contents_libseealso3` varchar(50) NOT NULL,
  `contents_answer` varchar(255) NOT NULL,
  PRIMARY KEY (`contents_id`),
  KEY `contents_title` (`contents_title`(40)),
  KEY `contents_visible_category_id` (`contents_active`,`contents_cid`)
) ENGINE=MyISAM AUTO_INCREMENT=0;
