DROP TABLE IF EXISTS `#__ccex_contacts`;
DROP TABLE IF EXISTS `#__ccex_euro_convertion_rates`;
DROP TABLE IF EXISTS `#__ccex_interval`;
DROP TABLE IF EXISTS `#__ccex_organization_org_types`;
DROP TABLE IF EXISTS `#__ccex_organization_types`;
DROP TABLE IF EXISTS `#__ccex_collections`;
DROP TABLE IF EXISTS `#__ccex_organizations`;
DROP TABLE IF EXISTS `#__ccex_countries`;
DROP TABLE IF EXISTS `#__ccex_currencies`;
DROP TABLE IF EXISTS `#__ccex_costs`;
DROP TABLE IF EXISTS `#__ccex_configurations`;

CREATE TABLE `#__ccex_organizations` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `other_org_type` varchar(255),
  `description` text,
  `country_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,

  `global_comparison` tinyint(1) NOT NULL DEFAULT 1,
  `peer_comparison` tinyint(1) NOT NULL DEFAULT 1,
  `organization_linked` tinyint(1) NOT NULL DEFAULT 1,
  `contact_and_sharing` tinyint(1) NOT NULL DEFAULT 1,
  `snapshots` tinyint(1) NOT NULL DEFAULT 1,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`organization_id`)
);

CREATE TABLE `#__ccex_organization_types` (
  `org_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  UNIQUE (`name`),
  PRIMARY KEY (`org_type_id`)
);

CREATE TABLE `#__ccex_organization_org_types` (
  `organization_org_type_id` int(11) NOT NULL AUTO_INCREMENT,

  `org_type_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  PRIMARY KEY (`organization_org_type_id`)
);

CREATE TABLE `#__ccex_collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,

  `scope` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `final` tinyint(1) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  PRIMARY KEY (`collection_id`)
);

CREATE TABLE `#__ccex_interval` (
  `interval_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL,

  `begin_year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,

  `data_volume` int(11) NOT NULL,
  `number_copies` int(11) NOT NULL,

  `staff` double NOT NULL,

  `asset_unformatted_text` double NOT NULL DEFAULT 0,
  `asset_word_processing` double NOT NULL DEFAULT 0,
  `asset_spreadsheet` double NOT NULL DEFAULT 0,
  `asset_graphics` double NOT NULL DEFAULT 0,
  `asset_audio` double NOT NULL DEFAULT 0,
  `asset_video` double NOT NULL DEFAULT 0,
  `asset_hypertext` double NOT NULL DEFAULT 0,
  `asset_geodata` double NOT NULL DEFAULT 0,
  `asset_email` double NOT NULL DEFAULT 0,
  `asset_database` double NOT NULL DEFAULT 0,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`interval_id`)
);

CREATE TABLE `#__ccex_costs` (
  `cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `interval_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cost` double NOT NULL,
  `human_resources` int(11) NOT NULL,

  `cat_hardware` double NOT NULL DEFAULT 0,
  `cat_software` double NOT NULL DEFAULT 0,
  `cat_external` double NOT NULL DEFAULT 0,
  `cat_producer` double NOT NULL DEFAULT 0,
  `cat_it_developer` double NOT NULL DEFAULT 0,
  `cat_operations` double NOT NULL DEFAULT 0,
  `cat_specialist` double NOT NULL DEFAULT 0,
  `cat_manager` double NOT NULL DEFAULT 0,
  `cat_overhead` double NOT NULL DEFAULT 0,

  `cat_pre_ingest` double NOT NULL DEFAULT 0,
  `cat_ingest` double NOT NULL DEFAULT 0,
  `cat_storage` double NOT NULL DEFAULT 0,
  `cat_access` double NOT NULL DEFAULT 0,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`cost_id`)
);

CREATE TABLE `#__ccex_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  UNIQUE (`name`),
  PRIMARY KEY (`country_id`)
);

CREATE TABLE `#__ccex_currencies` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,

  `symbol` varchar(8) NOT NULL,
  `code` varchar(8) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  UNIQUE (`code`),
  UNIQUE (`name`),
  PRIMARY KEY (`currency_id`)
);

CREATE TABLE `#__ccex_euro_convertion_rates` (
  `euro_convertion_id` int(11) NOT NULL AUTO_INCREMENT,

  `code` varchar(8) NOT NULL,
  `year` int(11) NOT NULL,
  `tax` double NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  UNIQUE (`code`,`year`),
  PRIMARY KEY (`euro_convertion_id`)
);

CREATE TABLE `#__ccex_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,

  `message` text NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `sender_organization_id` int(11) NOT NULL,
  `recipient_organization_id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `recipient_user_id` int(11) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  PRIMARY KEY (`contact_id`)
);

CREATE TABLE `#__ccex_configurations` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,

  `name` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `data_type` varchar(255) NOT NULL,

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  `published` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,

  UNIQUE (`identifier`),
  PRIMARY KEY (`configuration_id`)
);

INSERT INTO `#__ccex_organization_types` (`name`) VALUES ('University'), ('Memory institution or content holder'), ('Government agency'), ('Publisher or content producer'), ('Big data science'), ('Research funder'), ('Digital preservation vendor'), ('Industry'), ('Small or medium enterprise'), ('Other');
INSERT INTO `#__ccex_countries` (`name`) VALUES ('Afghanistan'), ('Albania'), ('Algeria'), ('American Samoa'), ('Andorra'), ('Angola'), ('Anguilla'), ('Antarctica'), ('Antigua and Barbuda'), ('Argentina'), ('Armenia'), ('Aruba'), ('Australia'), ('Austria'), ('Azerbaijan'), ('Bahrain'), ('Bangladesh'), ('Barbados'), ('Belarus'), ('Belgium'), ('Belize'), ('Benin'), ('Bermuda'), ('Bhutan'), ('Bolivia'), ('Bosnia and Herzegovina'), ('Botswana'), ('Bouvet Island'), ('Brazil'), ('British Indian Ocean Territory'), ('British Virgin Islands'), ('Brunei'), ('Bulgaria'), ('Burkina Faso'), ('Burundi'), ('Côte d\'Ivoire'), ('Cambodia'), ('Cameroon'), ('Canada'), ('Cape Verde'), ('Cayman Islands'), ('Central African Republic'), ('Chad'), ('Chile'), ('China'), ('Christmas Island'), ('Cocos (Keeling) Islands'), ('Colombia'), ('Comoros'), ('Congo'), ('Cook Islands'), ('Costa Rica'), ('Croatia'), ('Cuba'), ('Cyprus'), ('Czech Republic'), ('Democratic Republic of the Congo'), ('Denmark'), ('Djibouti'), ('Dominica'), ('Dominican Republic'), ('East Timor'), ('Ecuador'), ('Egypt'), ('El Salvador'), ('Equatorial Guinea'), ('Eritrea'), ('Estonia'), ('Ethiopia'), ('Faeroe Islands'), ('Falkland Islands'), ('Fiji'), ('Finland'), ('Former Yugoslav Republic of Macedonia'), ('France'), ('France, Metropolitan'), ('French Guiana'), ('French Polynesia'), ('French Southern Territories'), ('Gabon'), ('Georgia'), ('Germany'), ('Ghana'), ('Gibraltar'), ('Greece'), ('Greenland'), ('Grenada'), ('Guadeloupe'), ('Guam'), ('Guatemala'), ('Guinea'), ('Guinea-Bissau'), ('Guyana'), ('Haiti'), ('Heard and Mc Donald Islands'), ('Honduras'), ('Hong Kong'), ('Hungary'), ('Iceland'), ('India'), ('Indonesia'), ('Iran'), ('Iraq'), ('Ireland'), ('Israel'), ('Italy'), ('Jamaica'), ('Japan'), ('Jordan'), ('Kazakhstan'), ('Kenya'), ('Kiribati'), ('Kuwait'), ('Kyrgyzstan'), ('Laos'), ('Latvia'), ('Lebanon'), ('Lesotho'), ('Liberia'), ('Libya'), ('Liechtenstein'), ('Lithuania'), ('Luxembourg'), ('Macau'), ('Madagascar'), ('Malawi'), ('Malaysia'), ('Maldives'), ('Mali'), ('Malta'), ('Marshall Islands'), ('Martinique'), ('Mauritania'), ('Mauritius'), ('Mayotte'), ('Mexico'), ('Micronesia'), ('Moldova'), ('Monaco'), ('Mongolia'), ('Montenegro'), ('Montserrat'), ('Morocco'), ('Mozambique'), ('Myanmar'), ('Namibia'), ('Nauru'), ('Nepal'), ('Netherlands'), ('Netherlands Antilles'), ('New Caledonia'), ('New Zealand'), ('Nicaragua'), ('Niger'), ('Nigeria'), ('Niue'), ('Norfolk Island'), ('North Korea'), ('Northern Marianas'), ('Norway'), ('Oman'), ('Pakistan'), ('Palau'), ('Palestine'), ('Panama'), ('Papua New Guinea'), ('Paraguay'), ('Peru'), ('Philippines'), ('Pitcairn Islands'), ('Poland'), ('Portugal'), ('Puerto Rico'), ('Qatar'), ('Reunion'), ('Romania'), ('Russia'), ('Rwanda'), ('São Tomé and Príncipe'), ('Saint Helena'), ('St. Pierre and Miquelon'), ('Saint Kitts and Nevis'), ('Saint Lucia'), ('Saint Vincent and the Grenadines'), ('Samoa'), ('San Marino'), ('Saudi Arabia'), ('Senegal'), ('Serbia'), ('Seychelles'), ('Sierra Leone'), ('Singapore'), ('Slovakia'), ('Slovenia'), ('Solomon Islands'), ('Somalia'), ('South Africa'), ('South Georgia and the South Sandwich Islands'), ('South Korea'), ('Spain'), ('Sri Lanka'), ('Sudan'), ('Suriname'), ('Svalbard and Jan Mayen Islands'), ('Swaziland'), ('Sweden'), ('Switzerland'), ('Syria'), ('Taiwan'), ('Tajikistan'), ('Tanzania'), ('Thailand'), ('The Bahamas'), ('The Gambia'), ('Togo'), ('Tokelau'), ('Tonga'), ('Trinidad and Tobago'), ('Tunisia'), ('Turkey'), ('Turkmenistan'), ('Turks and Caicos Islands'), ('Tuvalu'), ('US Virgin Islands'), ('Uganda'), ('Ukraine'), ('United Arab Emirates'), ('United Kingdom'), ('United States'), ('United States Minor Outlying Islands'), ('Uruguay'), ('Uzbekistan'), ('Vanuatu'), ('Vatican City'), ('Venezuela'), ('Vietnam'), ('Wallis and Futuna Islands'), ('Western Sahara'), ('Yemen'), ('Zambia'), ('Zimbabwe');
INSERT INTO `#__ccex_currencies` (`name`, `symbol`, `code`) VALUES ('Euro', '€', 'EUR'), ('US Dollar', '$', 'USD'), ('British Pound', '£', 'GBP');
INSERT INTO `#__ccex_euro_convertion_rates` (`code`, `year`, `tax`) VALUES ('USD', 2013, 0.7532), ('USD', 2012, 0.7781), ('USD', 2011, 0.7188), ('USD', 2010, 0.7546), ('USD', 2009, 0.7190), ('USD', 2008, 0.6832), ('USD', 2007, 0.7306), ('USD', 2006, 0.7968), ('USD', 2005, 0.8043), ('USD', 2004, 0.8048), ('USD', 2003, 0.8851), ('USD', 2002, 1.0606), ('USD', 2001, 1.1163), ('USD', 2000, 1.0844), ('USD', 1999, 0.9387), ('USD', 1998, 0.8535), ('GBP', 2013, 1.1777), ('GBP', 2012, 1.2328), ('GBP', 2011, 1.1522), ('GBP', 2010, 1.1652), ('GBP', 2009, 1.1223), ('GBP', 2008, 1.2589), ('GBP', 2007, 1.4612), ('GBP', 2006, 1.4664), ('GBP', 2005, 1.4618), ('GBP', 2004, 1.4737), ('GBP', 2003, 1.4451), ('GBP', 2002, 1.5907), ('GBP', 2001, 1.6075), ('GBP', 2000, 1.6405), ('GBP', 1999, 1.5178), ('GBP', 1998, 1.4310);
INSERT INTO `#__ccex_configurations` (`name`, `identifier`, `value`, `data_type`) VALUES ('Minimum of organisations or collections to activate filters in the global comparison', 'minimum_organizations_global_comparison', 5, 'number'), ('Maximum number of years to present at once in analysis of my costs, if the organization has more years than the specified value, then the master chart is activated', 'maximum_years_my_costs_charts', 5, 'number'), ('Maximum ratio of weighted standard deviation to weighted arithmetic mean of a field, to being able to use the corresponding filter in the global comparison', 'maximum_ratio_valid_global_comparison', 0.3, 'number'), ('Maximum percentage of diferenfe between two values so that they are considered similar for global comparison', 'maximum_percentage_of_difference', 0.3, 'number'), ('Maximum number of other peers like you to present on peer comparison', 'maximum_other_peers_like_you', 5, 'number'), ('Score of type match between two organisations in calculation of peers like you', 'score_type_match', 50, 'number'), ('Score of data volume similarity between two organisations in calculation of peers like you', 'score_data_volume_similiarity', 40, 'number'), ('Score of main asset type equality in calculation of peers like you', 'score_main_asset_equality', 20, 'number'), ('Score of number of copies similarity between two organisations in calculation of peers like you', 'score_number_of_copies_similiarity', 20, 'number'), ('Score of staff similarity between two organisations in calculation of peers like you', 'score_staff_similiarity', 20, 'number'), ('Score of scopes match in calculation of peers like you', 'score_scopes_match', 10, 'number');
