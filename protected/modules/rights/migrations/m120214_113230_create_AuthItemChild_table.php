<?php

class m120214_113230_create_AuthItemChild_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{AuthItemChild}}', array(
			'parent'=> 'varchar(64) not null',
			'child'=> 'varchar(64) not null',
			'primary key (parent, child)',
		), 'ENGINE=INNODB DEFAULT CHARSET=utf8');

		$this->createIndex('index_AuthItemChild_parent', '{{AuthItemChild}}', 'parent');
		$this->createIndex('index_AuthItemChild_child', '{{AuthItemChild}}', 'child');
		$this->addForeignKey('reference_AuthItemChild_parent_to_AuthItem_name',
				'{{AuthItemChild}}', 'parent', '{{AuthItem}}', 'name', 'cascade', 'cascade');
		$this->addForeignKey('reference_AuthItemChild_child_to_AuthItem_name',
				'{{AuthItemChild}}', 'child', '{{AuthItem}}', 'name', 'cascade', 'cascade');
	}

	public function down()
	{
		$this->dropForeignKey('reference_AuthItemChild_parent_to_AuthItem_name', '{{AuthItemChild}}');
		$this->dropForeignKey('reference_AuthItemChild_child_to_AuthItem_name', '{{AuthItemChild}}');
		$this->dropTable('{{AuthItemChild}}');
	}
}