DROP TABLE IF EXISTS `#__ccex_organization_org_types`;
DROP TABLE IF EXISTS `#__ccex_organization_types`;
DROP TABLE IF EXISTS `#__ccex_collections`;
DROP TABLE IF EXISTS `#__ccex_organizations`;
DROP TABLE IF EXISTS `#__ccex_countries`;
DROP TABLE IF EXISTS `#__ccex_currencies`;
DROP TABLE IF EXISTS `#__ccex_costs`;

CREATE TABLE `#__ccex_organizations` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
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

CREATE TABLE `#__ccex_organization_types` (
  `org_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`org_type_id`)
);

CREATE TABLE `#__ccex_organization_org_types` (
  `organization_org_type_id` int(11) NOT NULL AUTO_INCREMENT,

  `org_type_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`organization_org_type_id`)
);

CREATE TABLE `#__ccex_collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `ǹame` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `data_volume` int(11) NOT NULL DEFAULT 0,
  `number_copies` int(11) NOT NULL DEFAULT 0,

  `scope` varchar(255) NOT NULL DEFAULT '',
  `staff_min_size` int(11) NOT NULL DEFAULT 0,
  `staff_max_size` int(11) NOT NULL DEFAULT 0,

  `asset_unformatted_text` int(11) NOT NULL DEFAULT 0,
  `asset_word_processing` int(11) NOT NULL DEFAULT 0,
  `asset_spreadsheet` int(11) NOT NULL DEFAULT 0,
  `asset_graphics` int(11) NOT NULL DEFAULT 0,
  `asset_audio` int(11) NOT NULL DEFAULT 0,
  `asset_video` int(11) NOT NULL DEFAULT 0,
  `asset_hypertext` int(11) NOT NULL DEFAULT 0,
  `asset_geodata` int(11) NOT NULL DEFAULT 0,
  `asset_email` int(11) NOT NULL DEFAULT 0,
  `asset_database` int(11) NOT NULL DEFAULT 0,
  `asset_research_data` int(11) NOT NULL DEFAULT 0,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`collection_id`)
);

CREATE TABLE `#__ccex_costs` (
  `cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL DEFAULT '',
  `cost` double NOT NULL DEFAULT 0,
  `human_resources` int(11) NOT NULL DEFAULT 0,

  `cat_hardware` int(11) NOT NULL DEFAULT 0,
  `cat_software` int(11) NOT NULL DEFAULT 0,
  `cat_external` int(11) NOT NULL DEFAULT 0,
  `cat_producer` int(11) NOT NULL DEFAULT 0,
  `cat_it_developer` int(11) NOT NULL DEFAULT 0,
  `cat_support` int(11) NOT NULL DEFAULT 0,
  `cat_analyst` int(11) NOT NULL DEFAULT 0,
  `cat_manager` int(11) NOT NULL DEFAULT 0,
  `cat_overhead` int(11) NOT NULL DEFAULT 0,

  `cat_production` int(11) NOT NULL DEFAULT 0,
  `cat_ingest` int(11) NOT NULL DEFAULT 0,
  `cat_storage` int(11) NOT NULL DEFAULT 0,
  `cat_access` int(11) NOT NULL DEFAULT 0,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`cost_id`)
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
  `name` varchar(255) NOT NULL DEFAULT '',
  `symbol` varchar(8) NOT NULL DEFAULT '',

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`currency_id`)
);

INSERT INTO `#__ccex_organization_types` (`name`) VALUES ('Big data science'), ('Industry'), ('University'), ('Memory institution'), ('Government agency'), ('Other');
INSERT INTO `#__ccex_countries` (`name`) VALUES ('Portugal'), ('Angola'), ('Spain');
INSERT INTO `#__ccex_currencies` (`name`, `symbol`) VALUES ('Euro', '€'), ('Canadian dollar', '$');
INSERT INTO `#__ccex_costs` (`name`, `cost`, `human_resources`, `collection_id`) VALUES ('Format migration', 14000, 10, 1), ('Format migration', 14000, 10, 2);
