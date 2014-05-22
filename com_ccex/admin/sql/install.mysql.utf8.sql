DROP TABLE IF EXISTS `#__ccex_organization_types`;
DROP TABLE IF EXISTS `#__ccex_profile_assets`;
DROP TABLE IF EXISTS `#__ccex_profile_scopes`;
DROP TABLE IF EXISTS `#__ccex_organization_profiles`;
DROP TABLE IF EXISTS `#__ccex_organizations`;
DROP TABLE IF EXISTS `#__ccex_countries`;
DROP TABLE IF EXISTS `#__ccex_currencies`;

CREATE TABLE `#__ccex_organizations` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `org_type_id` int(11) NOT NULL,
  `other_org_type` varchar(255),
  `description` text,
  `country_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,

  `linked_data_provider` tinyint(1) NOT NULL DEFAULT 0,
  `linked_cost_data` tinyint(1) NOT NULL DEFAULT 0,

  `share_information` enum('everyone', 'trusted') NOT NULL DEFAULT 'everyone',
  `share_data` enum('everyone', 'trusted') NOT NULL DEFAULT 'everyone',

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`organization_id`)
);

CREATE TABLE `#__ccex_organization_profiles` (
  `org_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `profile_scope_id` int(11),
  `data_volume` int(11) NOT NULL,
  `number_copies` int(11) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`org_profile_id`)
);

CREATE TABLE `#__ccex_profile_assets` (
  `profile_asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_type` varchar(255) NOT NULL,
  `org_profile_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`profile_asset_id`)
);

CREATE TABLE `#__ccex_profile_scopes` (
  `profile_scope_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `min_size` int(11) NOT NULL DEFAULT 0,
  `max_size` int(11),

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`profile_scope_id`)
);

CREATE TABLE `#__ccex_organization_types` (
  `org_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`org_type_id`)
);

CREATE TABLE `#__ccex_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`country_id`)
);

CREATE TABLE `#__ccex_currencies` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`currency_id`)
);

INSERT INTO `#__ccex_organization_types` (`name`) VALUES ('Big data science'), ('Industry'), ('Other');
INSERT INTO `#__ccex_countries` (`name`) VALUES ('Portugal'), ('Angola'), ('Spain');
INSERT INTO `#__ccex_currencies` (`name`) VALUES ('Euro'), ('Canadian dollar');
