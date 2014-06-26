DROP TABLE IF EXISTS `#__ccex_interval`;
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

  `global_comparison` tinyint(1) NOT NULL DEFAULT 0,
  `peer_comparison` tinyint(1) NOT NULL DEFAULT 0,
  `contact_and_sharing` tinyint(1) NOT NULL DEFAULT 0,
  `snapshots` tinyint(1) NOT NULL DEFAULT 0,

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
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',

  `scope` varchar(255) NOT NULL DEFAULT '',

  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL,

  PRIMARY KEY (`collection_id`)
);

CREATE TABLE `#__ccex_interval` (
  `interval_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL,

  `begin_year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,

  `data_volume` int(11) NOT NULL DEFAULT 0,
  `number_copies` int(11) NOT NULL DEFAULT 0,

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

  PRIMARY KEY (`interval_id`)
);

CREATE TABLE `#__ccex_costs` (
  `cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `interval_id` int(11) NOT NULL,
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

INSERT INTO `#__ccex_organization_types` (`name`) VALUES ('University'), ('Memory institution or content holder'), ('Government agency'), ('Publisher or content producer'), ('Big data science'), ('Research funder'), ('Digital preservation vendor'), ('Industry'), ('Small or medium enterprise'), ('Other');
INSERT INTO `#__ccex_countries` (`name`) VALUES ('Afghanistan'), ('Albania'), ('Algeria'), ('American Samoa'), ('Andorra'), ('Angola'), ('Anguilla'), ('Antarctica'), ('Antigua and Barbuda'), ('Argentina'), ('Armenia'), ('Aruba'), ('Australia'), ('Austria'), ('Azerbaijan'), ('Bahrain'), ('Bangladesh'), ('Barbados'), ('Belarus'), ('Belgium'), ('Belize'), ('Benin'), ('Bermuda'), ('Bhutan'), ('Bolivia'), ('Bosnia and Herzegovina'), ('Botswana'), ('Bouvet Island'), ('Brazil'), ('British Indian Ocean Territory'), ('British Virgin Islands'), ('Brunei'), ('Bulgaria'), ('Burkina Faso'), ('Burundi'), ('Côte d\'Ivoire'), ('Cambodia'), ('Cameroon'), ('Canada'), ('Cape Verde'), ('Cayman Islands'), ('Central African Republic'), ('Chad'), ('Chile'), ('China'), ('Christmas Island'), ('Cocos (Keeling) Islands'), ('Colombia'), ('Comoros'), ('Congo'), ('Cook Islands'), ('Costa Rica'), ('Croatia'), ('Cuba'), ('Cyprus'), ('Czech Republic'), ('Democratic Republic of the Congo'), ('Denmark'), ('Djibouti'), ('Dominica'), ('Dominican Republic'), ('East Timor'), ('Ecuador'), ('Egypt'), ('El Salvador'), ('Equatorial Guinea'), ('Eritrea'), ('Estonia'), ('Ethiopia'), ('Faeroe Islands'), ('Falkland Islands'), ('Fiji'), ('Finland'), ('Former Yugoslav Republic of Macedonia'), ('France'), ('France, Metropolitan'), ('French Guiana'), ('French Polynesia'), ('French Southern Territories'), ('Gabon'), ('Georgia'), ('Germany'), ('Ghana'), ('Gibraltar'), ('Greece'), ('Greenland'), ('Grenada'), ('Guadeloupe'), ('Guam'), ('Guatemala'), ('Guinea'), ('Guinea-Bissau'), ('Guyana'), ('Haiti'), ('Heard and Mc Donald Islands'), ('Honduras'), ('Hong Kong'), ('Hungary'), ('Iceland'), ('India'), ('Indonesia'), ('Iran'), ('Iraq'), ('Ireland'), ('Israel'), ('Italy'), ('Jamaica'), ('Japan'), ('Jordan'), ('Kazakhstan'), ('Kenya'), ('Kiribati'), ('Kuwait'), ('Kyrgyzstan'), ('Laos'), ('Latvia'), ('Lebanon'), ('Lesotho'), ('Liberia'), ('Libya'), ('Liechtenstein'), ('Lithuania'), ('Luxembourg'), ('Macau'), ('Madagascar'), ('Malawi'), ('Malaysia'), ('Maldives'), ('Mali'), ('Malta'), ('Marshall Islands'), ('Martinique'), ('Mauritania'), ('Mauritius'), ('Mayotte'), ('Mexico'), ('Micronesia'), ('Moldova'), ('Monaco'), ('Mongolia'), ('Montenegro'), ('Montserrat'), ('Morocco'), ('Mozambique'), ('Myanmar'), ('Namibia'), ('Nauru'), ('Nepal'), ('Netherlands'), ('Netherlands Antilles'), ('New Caledonia'), ('New Zealand'), ('Nicaragua'), ('Niger'), ('Nigeria'), ('Niue'), ('Norfolk Island'), ('North Korea'), ('Northern Marianas'), ('Norway'), ('Oman'), ('Pakistan'), ('Palau'), ('Palestine'), ('Panama'), ('Papua New Guinea'), ('Paraguay'), ('Peru'), ('Philippines'), ('Pitcairn Islands'), ('Poland'), ('Portugal'), ('Puerto Rico'), ('Qatar'), ('Reunion'), ('Romania'), ('Russia'), ('Rwanda'), ('São Tomé and Príncipe'), ('Saint Helena'), ('St. Pierre and Miquelon'), ('Saint Kitts and Nevis'), ('Saint Lucia'), ('Saint Vincent and the Grenadines'), ('Samoa'), ('San Marino'), ('Saudi Arabia'), ('Senegal'), ('Serbia'), ('Seychelles'), ('Sierra Leone'), ('Singapore'), ('Slovakia'), ('Slovenia'), ('Solomon Islands'), ('Somalia'), ('South Africa'), ('South Georgia and the South Sandwich Islands'), ('South Korea'), ('Spain'), ('Sri Lanka'), ('Sudan'), ('Suriname'), ('Svalbard and Jan Mayen Islands'), ('Swaziland'), ('Sweden'), ('Switzerland'), ('Syria'), ('Taiwan'), ('Tajikistan'), ('Tanzania'), ('Thailand'), ('The Bahamas'), ('The Gambia'), ('Togo'), ('Tokelau'), ('Tonga'), ('Trinidad and Tobago'), ('Tunisia'), ('Turkey'), ('Turkmenistan'), ('Turks and Caicos Islands'), ('Tuvalu'), ('US Virgin Islands'), ('Uganda'), ('Ukraine'), ('United Arab Emirates'), ('United Kingdom'), ('United States'), ('United States Minor Outlying Islands'), ('Uruguay'), ('Uzbekistan'), ('Vanuatu'), ('Vatican City'), ('Venezuela'), ('Vietnam'), ('Wallis and Futuna Islands'), ('Western Sahara'), ('Yemen'), ('Zambia'), ('Zimbabwe');
INSERT INTO `#__ccex_currencies` (`name`, `symbol`) VALUES ('Euro', '€'), ('Canadian dollar', '$');
