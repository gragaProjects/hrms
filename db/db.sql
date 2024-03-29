----11-12-23
ALTER TABLE `employee` ADD `password_changed` INT(11) NULL DEFAULT '0' AFTER `notification_status`;

----11-12-23

CREATE TABLE IF NOT EXISTS template_default (
id int(11) NOT NULL,
  busunit varchar(255) DEFAULT NULL,
  header varchar(255) DEFAULT NULL,
  footer varchar(255) DEFAULT NULL,
  watermark varchar(255) DEFAULT NULL,
  createdon timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  isActive int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


ALTER TABLE template_default
 ADD PRIMARY KEY (id);

ALTER TABLE template_default
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;


-- --------------------------------------------------------

----13-12-23
--
-- Table structure for table 'policies_accept'
--

CREATE TABLE IF NOT EXISTS policies_accept (
id int(11) NOT NULL,
  policy_id int(11) NOT NULL,
  employee_id varchar(11) NOT NULL,
  accepted_status tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
ALTER TABLE policies_accept
 ADD PRIMARY KEY (id);


ALTER TABLE policies_accept
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;




-- --------------------------------------------------------



ALTER TABLE `certificate_content` ADD `title` VARCHAR(55) NOT NULL ;