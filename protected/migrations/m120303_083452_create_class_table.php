<?php

class m120303_083452_create_class_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{class}}', array(
			'class_pk'=>'bigint(20) NOT NULL AUTO_INCREMENT',
			'class_ref_room_pk'=>'bigint(20) NULL',
			'class_ref_room_no'=>'varchar(32) NULL',
			'class_start_date'=>'date NULL',
			'class_end_date'=>'date NULL',
			'class_start_time'=>'time NULL',
			'class_end_time'=>'time NULL',
			'class_status'=> 'VARCHAR(16) NOT NULL DEFAULT "NEW"',
			'class_days_on_week'=>'varchar(128) NULL',
			'class_ref_batch_pk'=> 'bigint(20) NOT NULL',
			'class_ref_batch_id'=> 'varchar(32) NOT NULL',
			'class_ref_subject_pk'=> 'bigint(20) NOT NULL',
			'class_ref_subject_name'=> 'bigint(20) NOT NULL',
			'PRIMARY KEY (class_pk)',
			'UNIQUE KEY (class_ref_batch_pk, class_ref_subject_pk)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('{{class}}');
	}
}