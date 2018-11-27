<?php

class m120214_122728_create_Rights_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{Rights}}', array(
			'itemname'=> 'varchar(64) not null primary key',
			'type'=> 'integer not null',
			'weight'=> 'integer not null',
		), 'ENGINE=INNODB DEFAULT CHARSET=utf8');
		$this->addForeignKey('reference_Rights_itemname_to_AuthItem_name',
				'{{Rights}}', 'itemname', '{{AuthItem}}', 'name', 'cascade', 'cascade');
	}

	public function down()
	{
		$this->dropForeignKey('reference_Rights_itemname_to_AuthItem_name', '{{Rights}}');
		$this->dropTable('{{Rights}}');
	}
}