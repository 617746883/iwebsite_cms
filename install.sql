DROP TABLE IF EXISTS `iwebsite_system_copyright`;
CREATE TABLE `iwebsite_system_copyright` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bgcolor` varchar(255) DEFAULT '',
  `ismanage` tinyint(3) DEFAULT '0',
  `logo` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `copyright` text,
  `agreement` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_sysset`;
CREATE TABLE `iwebsite_sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sets` longtext,
  `plugins` longtext,
  `sec` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_admin`;
CREATE TABLE `iwebsite_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `joindate` int(10) unsigned NOT NULL,
  `joinip` varchar(15) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL,
  `lastip` varchar(15) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iwebsite_admin
-- ----------------------------
INSERT INTO `iwebsite_admin` VALUES ('1', '/public/attachment/images/20180711/89bea514e1d302d006fac4d8ba69d22f.jpg', 'admin', 'f374baf63f70a5c2c4d172a0a6e37897', 'U66yPU04', '0', '3981c97704e6ba956597ec3873745be05d965947', '1', '1532331947', '182.245.71.7', '1548638728', '116.52.98.73', 'wqe12', '0', '0');
INSERT INTO `iwebsite_admin` VALUES ('3', '/public/attachment/images/20180719/fd38d78f8dfe912b836e4ff320bbebcf.jpg', 'test', '438b6acb8aca7eea3295ffb62cbc238a', 'yoHo3WGS', '0', 'ead29ada1a8c5cfc982f65383fd5b0', '1', '1532612737', '14.204.0.220', '1535596524', '182.245.71.15', '', '0', '0');
INSERT INTO `iwebsite_admin` VALUES ('2', '/public/attachment/images/20180530/0847d00bfcc965c68a7ac014715270aa.jpg', 'administrator', 'db2bb0639cac699703e537ac2f2c9439', 'lVRVVp9g', '0', 'bb7957a7425b43c6774449904239b0', '1', '1532408484', '218.63.141.87', '1544509434', '182.245.71.143', 'ces121312', '1544492160', '1545096960');
INSERT INTO `iwebsite_admin` VALUES ('4', '/public/attachment/images/20180716/a4f5aeab52c188a099d99c037650288f.png', 'doncheng', '45ef1cdcde019d8f73baf65e493ec9d6', 'fYufupRr', '0', 'c9a3ab10825e39e8a1e05f13a1869d', '1', '1533277779', '218.63.141.110', '1535599463', '182.245.71.15', '', '0', '0');
INSERT INTO `iwebsite_admin` VALUES ('5', '/public/attachment/images/20181211/b9d99bfae1966d0857fbd5969112aa04.jpg', 'zhuxietong', '9fd9e703768c9e6d8c96c4bb66033622', 'wN9J66ih', '0', '51b9b913719e39b8f5732a6361803cc8b3a283a8', '1', '1544602773', '182.245.71.143', '1548642687', '116.52.98.73', '', '1544602680', '1589357880');
INSERT INTO `iwebsite_admin` VALUES ('6', '', 'xiaoxiao', '1e08935529e6a61438593beea6feeac3', 'u4ccRvFP', '0', '4942ae930ad8bf64d50dca060119cff64e7d30f8', '1', '1545025974', '218.63.141.38', '1548060617', '116.52.34.81', '', '1545025860', '1590731460');
INSERT INTO `iwebsite_admin` VALUES ('7', '/public/attachment/images/20181225/0dc8f23de837babb72a160b5a3ca6756.jpg', 'zhutong', '6691b00d6a18573f9064bece36fc6d12', 'zd8h44iW', '0', '33de0ac2a03ed2e5b00d6661b43fa07fcd03109d', '1', '1547170977', '116.52.34.235', '1547713498', '116.52.98.177', '安卓测试', '1547090460', '1611285660');
INSERT INTO `iwebsite_admin` VALUES ('8', '', 'maxiang', 'e6a6b3d52bd90f2b3b904a29a74f50f8', 'TMollg7G', '0', '9ab2414f9a6d5cbd4bf9cd815c97bc9d7c4c3a6f', '1', '1548214740', '116.52.120.41', '1548214740', '116.52.120.41', '', '1548214680', '1555731480');

DROP TABLE IF EXISTS `iwebsite_admin_log`;
CREATE TABLE `iwebsite_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) DEFAULT '0',
  `type` varchar(255) DEFAULT '',
  `op` text,
  `createtime` int(11) DEFAULT '0',
  `ip` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_adminid` (`adminid`),
  KEY `idx_createtime` (`createtime`),
  FULLTEXT KEY `idx_type` (`type`),
  FULLTEXT KEY `idx_op` (`op`)
) ENGINE=MyISAM AUTO_INCREMENT=723 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_column`;
CREATE TABLE `iwebsite_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(3) DEFAULT '0',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `photo` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `list_type` varchar(100) NOT NULL DEFAULT '0',
  `content_type` varchar(100) NOT NULL DEFAULT '0',
  `power` varchar(255) NOT NULL DEFAULT '',
  `page` tinyint(1) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `page_number` int(11) NOT NULL DEFAULT '1',
  `outlink` varchar(255) NOT NULL DEFAULT '',
  `outlink_state` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_content`;
CREATE TABLE `iwebsite_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `columnid` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `thumb` text NOT NULL,
  `content` longtext,
  `date_v` varchar(20) NOT NULL DEFAULT '',
  `mp` varchar(50) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `readnum_v` int(11) NOT NULL DEFAULT '0',
  `readnum` int(11) NOT NULL DEFAULT '0',
  `likenum_v` int(11) NOT NULL DEFAULT '0',
  `likenum` int(11) NOT NULL DEFAULT '0',
  `outlink` varchar(255) NOT NULL DEFAULT '',
  `outlink_state` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `isrecommand` tinyint(3) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_columnid` (`columnid`),
  KEY `idx_title` (`title`),
  KEY `idx_content` (`content`(10))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='内容';

DROP TABLE IF EXISTS `iwebsite_auth_rule`;
CREATE TABLE `iwebsite_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_auth_group`;
CREATE TABLE `iwebsite_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_auth_group_access`;
CREATE TABLE `iwebsite_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_system_copyright`;
CREATE TABLE `iwebsite_system_copyright` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bgcolor` varchar(255) DEFAULT '',
  `ismanage` tinyint(3) DEFAULT '0',
  `logo` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `copyright` text,
  `agreement` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_banner`;
CREATE TABLE `iwebsite_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bannername` varchar(50) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_comment`;
CREATE TABLE `iwebsite_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL DEFAULT '0',
  `name` char(100) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `call` int(30) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_link`;
CREATE TABLE `iwebsite_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_core_attachment`;
CREATE TABLE `iwebsite_core_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `module_upload_dir` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=500 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_attachment_group`;
CREATE TABLE `iwebsite_attachment_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_comment`;
CREATE TABLE `iwebsite_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` int(20) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `good` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iwebsite_comment_more`;
CREATE TABLE `iwebsite_comment_more` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` int(20) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `good` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;