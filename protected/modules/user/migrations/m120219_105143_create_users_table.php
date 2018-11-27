<?php

class m120219_105143_create_users_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{users}}', array(
			'id'=> 'int(11) NOT NULL AUTO_INCREMENT',
			'username'=> 'varchar(20) NOT NULL',
			'password'=> 'varchar(128) NOT NULL',
			'email'=> 'varchar(128) NOT NULL',
			'activkey'=> 'varchar(128) NOT NULL DEFAULT ""',
			'createtime'=> 'int(10) NOT NULL DEFAULT 0',
			'lastvisit'=> 'int(10) NOT NULL DEFAULT 0',
			'superuser'=> 'int(1) NOT NULL DEFAULT 0',
			'status'=> 'int(1) NOT NULL DEFAULT 0',
			'PRIMARY KEY (`id`)',
			'UNIQUE KEY `username` (`username`)',
			'UNIQUE KEY `email` (`email`)',
			'KEY `status` (`status`)',
			'KEY `superuser` (`superuser`)',
		),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');
	}

	public function down()
	{
		$this->dropTable('{{users}}');
	}
}