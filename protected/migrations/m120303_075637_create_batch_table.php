<?php

class m120303_075637_create_batch_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{batch}}', array(
			'batch_pk'=>  'bigint(20) NOT NULL AUTO_INCREMENT',
			'batch_id'=> 'varchar(32) NOT NULL',
			'batch_start_date'=> 'DATE NULL',
			'batch_end_date'=> 'DATE NULL',
			'batch_status'=> 'VARCHAR(16) NOT NULL DEFAULT "NEW"',
			'batch_ref_course_pk'=> 'bigint(20) NULL',
			'batch_ref_course_name'=> 'varchar(128) NOT NULL',
			'PRIMARY KEY (batch_pk)',
			'UNIQUE KEY (batch_id)',
			'KEY (batch_ref_course_pk)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{batch}}');
	}
}