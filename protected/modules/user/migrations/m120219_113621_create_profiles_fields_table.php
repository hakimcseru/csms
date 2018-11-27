<?php

class m120219_113621_create_profiles_fields_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{profiles_fields}}', array(
			'id'=> 'int(10) NOT NULL AUTO_INCREMENT',
			'varname'=> 'varchar(50) NOT NULL',
			'title'=> 'varchar(255) NOT NULL',
			'field_type'=> 'varchar(50) NOT NULL',
			'field_size'=> 'int(3) NOT NULL DEFAULT 0',
			'field_size_min'=> 'int(3) NOT NULL DEFAULT 0',
			'required'=> 'int(1) NOT NULL DEFAULT 0',
			'match'=> 'varchar(255) NOT NULL DEFAULT ""',
			'range'=> 'varchar(255) NOT NULL DEFAULT ""',
			'error_message'=> 'varchar(255) NOT NULL DEFAULT ""',
			'other_validator'=> 'varchar(5000) NOT NULL DEFAULT ""',
			'default'=> 'varchar(255) NOT NULL DEFAULT ""',
			'widget'=> 'varchar(255) NOT NULL DEFAULT ""',
			'widgetparams'=> 'varchar(5000) NOT NULL DEFAULT ""',
			'position'=> 'int(3) NOT NULL DEFAULT 0',
			'visible'=> 'int(1) NOT NULL DEFAULT 0',
			"PRIMARY KEY (id)",
			"KEY varname (varname,widget,visible)",
		),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4');
	}

	public function down()
	{
		$this->dropTable('{{profiles_fields}}');
	}
}