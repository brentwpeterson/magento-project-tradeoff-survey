<?php
$installer = $this;
$installer->startSetup();

/*create survey table*/
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('client/survey')};
CREATE TABLE {$this->getTable('client/survey')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `position` text,
  `cost` int(2)  NULL,
  `cost_comment` text,
  `duration` int(2)  NULL,
  `duration_comment` text,
  `user_adoption` int(2)  NULL,
  `user_adoption_comment` text,
  `project_goals` int(2)  NULL,
  `project_goals_comment` text,
  `certainty` int(2)  NULL,
  `certainty_comment` text,
  `create_at` timestamp NULL,
  `updated_at` timestamp NULL,
  `status` tinyint(1),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
