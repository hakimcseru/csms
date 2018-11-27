<?php

class m120320_105326_create_calendar_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{calendar}}', array(
			'calendar_pk'=>  'bigint(20) NOT NULL AUTO_INCREMENT',
			'calendar_ref_room_pk'=> 'bigint(20) NOT NULL',
			'calendar_ref_room_no'=> 'varchar(32) NOT NULL',
			'calendar_title'=> 'varchar(128) NOT NULL',
			'calendar_description'=> 'TEXT NULL',
			'calendar_date'=> 'date NOT NULL',
			'calendar_start_time'=> 'time NOT NULL',
			'calender_end_time'=> 'time NOT NULL',
			'calendar_link'=> 'varchar(256) NULL',
			'PRIMARY KEY (calendar_pk)',
			'KEY (calendar_date)',
			'KEY (calendar_start_time)',
			'KEY (calender_end_time)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{calendar}}');
	}
}