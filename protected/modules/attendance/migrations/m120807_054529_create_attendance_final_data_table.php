<?php

class m120807_054529_create_attendance_final_data_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{attendance_final_data}}', array(
			'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'core_employee_id' => 'BIGINT UNSIGNED NOT NULL',
			'core_employee_name' => 'VARCHAR(128) NOT NULL',
			'core_shift_id' => 'BIGINT UNSIGNED NULL',
			'core_shift_name' =>'VARCHAR(64) NOT NULL',
			'core_department_id' => 'BIGINT UNSIGNED NULL',
			'core_department_name'=>'VARCHAR(128) NOT NULL',
			'date' => 'DATE NOT NULL',
			'status' => 'VARCHAR(16) NOT NULL',
			'in_time' => 'DATETIME NULL',
			'break_start'=> 'DATETIME NULL',
			'break_end'=> 'DATETIME NULL',
			'out_time' => 'DATETIME NULL',
			'work_hour'=> 'INTEGER NOT NULL DEFAULT 0',
			'over_time' => 'INTEGER NOT NULL DEFAULT 0',
			'note' => 'VARCHAR(256)',
			'json_log'=>'TEXT',
			), 'ENGINE=MYISM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
		);
		$this->createIndex('attendance_final_data_core_employee_id_NN', '{{attendance_final_data}}', 'core_employee_id');
		$this->createIndex('attendance_final_data_core_shift_id_NN', '{{attendance_final_data}}', 'core_shift_id');
		$this->createIndex('attendance_final_data_core_department_id_NN', '{{attendance_final_data}}', 'core_department_id');
		$this->createIndex('attendance_final_data_date_NN', '{{attendance_final_data}}', 'date');
		$this->createIndex('attendance_final_data_status_NN', '{{attendance_final_data}}', 'status');
	}

	public function down()
	{
		$this->dropTable('{{attendance_final_data}}');
	}
}