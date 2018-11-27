<?php

class m120214_081657_create_AuthItem_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{AuthItem}}', array(
			'name'=> 'varchar(64) not null primary key',
			'type'=> 'integer not null',
			'description'=> 'text',
			'bizrule'=> 'text',
			'data'=> 'text',
		), 'ENGINE=INNODB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('{{AuthItem}}');
	}
}