<?php

class m111204_073659_create_table_attendance_temp_data extends CDbMigration {

	public function up() {
		$this->createTable('{{attendance_temp_data}}', array(
			'id' => 'bigint unsigned not null auto_increment primary key',
			'core_employee_id' => 'bigint not null',
			'date' => 'date not null',
			'time' => 'datetime not null',
			'mode' => 'varchar(4) not null',
			'note' => 'VARCHAR(256) NULL',
				), 'ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
		);
		$this->createIndex('attendance_temp_data_core_employee_id_NN', '{{attendance_temp_data}}', 'core_employee_id');
		$this->createIndex('attendance_temp_data_date_NN', '{{attendance_temp_data}}', 'date');
		$this->createIndex('attendance_temp_data_time_NN', '{{attendance_temp_data}}', 'time');
	}

	public function down() {
		$this->dropTable('{{attendance_temp_data}}');
	}

}