<?php

class m111205_100400_create_table_attendance_leave extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{attendance_leave}}', array(
			'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'core_employee_id' => 'BIGINT UNSIGNED NOT NULL',
			'start_date' => 'DATE NOT NULL',
			'end_date' => 'DATE NOT NULL',
			'duration' => 'DOUBLE NOT NULL',
			'type' => 'VARCHAR(4) NOT NULL',
			'description' =>'VARCHAR(256) NULL',
			'responsible_person_id'=> 'BIGINT UNSIGNED NULL',
			'approved_by_id'=> 'BIGINT UNSIGNED NULL',
			'note' => 'VARCHAR(256) NULL',
			), 'ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
		);

		$this->createIndex('attendance_leave_core_employee_id_NN', '{{attendance_leave}}', 'core_employee_id');
		$this->createIndex('attendance_leave_responsible_person_id_NN', '{{attendance_leave}}', 'responsible_person_id');
		$this->createIndex('attendance_leave_approved_by_id_NN', '{{attendance_leave}}', 'approved_by_id');
		$this->createIndex('attendance_leave_start_date_NN', '{{attendance_leave}}', 'start_date');
		$this->createIndex('attendance_leave_end_date_NN', '{{attendance_leave}}', 'end_date');
		$this->createIndex('attendance_leave_type', '{{attendance_leave}}', 'type');

		$this->addForeignKey('FK_attendance_leave_core_employee_id', '{{attendance_leave}}', 'core_employee_id',
				'{{core_employee}}', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('FK_attendance_leave_responsible_person_id', '{{attendance_leave}}', 'responsible_person_id',
				'{{core_employee}}', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('FK_attendance_leave_approved_by_id', '{{attendance_leave}}', 'approved_by_id',
				'{{core_employee}}', 'id', 'SET NULL', 'SET NULL');
	}

	public function down()
	{
		$this->dropForeignKey('FK_attendance_leave_approved_by_id', '{{attendance_leave}}');
		$this->dropForeignKey('FK_attendance_leave_responsible_person_id', '{{attendance_leave}}');
		$this->dropForeignKey('FK_attendance_leave_core_employee_id', '{{attendance_leave}}');
		$this->dropTable('{{attendance_leave}}');
	}
}