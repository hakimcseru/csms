<?php

class m120320_053948_create_room_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{room}}', array(
			'room_pk'=>  'bigint(20) NOT NULL AUTO_INCREMENT',
			'room_no'=> 'varchar(32) NOT NULL',
			'room_description'=> 'TEXT NULL',
			'room_capacity'=> 'smallint NULL',
			'room_condition'=> 'VARCHAR(16) NOT NULL DEFAULT "GOOD"',
			'room_type'=> 'VARCHAR(16) NOT NULL DEFAULT "CLASSROOM"',
			'PRIMARY KEY (room_pk)',
			'UNIQUE KEY (room_no)',
			'KEY (room_type)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{room}}');
	}
}