<?php

class m120806_095954_create_attendance_calendar_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{attendance_calendar}}', array(
			'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'date' => 'DATE NOT NULL',
			'type' => 'VARCHAR(4) NOT NULL',
			'title'=> 'VARCHAR(64) NULL',
			'note' => 'VARCHAR(256) NULL',
			'processed_on'=>'DATETIME NULL',
			'status'=> 'BOOLEAN NOT NULL DEFAULT 0',
			), 'ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
		);
		$this->createIndex('attendance_calendar_date_UN', '{{attendance_calendar}}', 'date', true);
		$this->createIndex('attendance_calendar_type_NN', '{{attendance_calendar}}', 'type', false);
		$this->createIndex('attendance_calendar_status_NN', '{{attendance_calendar}}', 'status', false);
	}

	public function down()
	{
		$this->dropTable('{{attendance_calendar}}');
	}
}