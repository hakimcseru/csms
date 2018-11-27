<?php

class m120214_121535_create_AuthAssignment_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{AuthAssignment}}', array(
			'itemname'=> 'varchar(64) not null',
			'userid'=> 'varchar(64) not null',
			'bizrule'=> 'text',
			'data'=> 'text',
			'primary key (itemname,userid)',
		), 'ENGINE=INNODB DEFAULT CHARSET=utf8');

		$this->createIndex('index_AuthAssignment_itemname', '{{AuthAssignment}}', 'itemname');
		$this->addForeignKey('reference_AuthAssignment_itemname_to_AuthItem_name',
				'{{AuthAssignment}}', 'itemname', '{{AuthItem}}', 'name', 'cascade', 'cascade');
	}

	public function down()
	{
		$this->dropForeignKey('reference_AuthAssignment_itemname_to_AuthItem_name', '{{AuthAssignment}}');
		$this->dropTable('{{AuthAssignment}}');
	}
}