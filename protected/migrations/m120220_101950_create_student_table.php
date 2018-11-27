<?php

class m120220_101950_create_student_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{student}}', array(
			'student_id'=> 'varchar(16) NOT NULL',
			'student_name'=> 'varchar(128) NOT NULL',
			'student_father_name'=> 'varchar(128) NOT NULL',
			'student_mother_name'=> 'varchar(128) NOT NULL',
			'student_present_address'=> 'text NOT NULL',
			'student_permanent_address'=> 'text NOT NULL',
			'student_nationality'=> 'varchar(32) NOT NULL',
			'student_gender'=> 'enum("MALE","FEMALE") NOT NULL',
			'student_dob'=> 'date NOT NULL',
			'student_pob'=> 'varchar(32) DEFAULT NULL',
			'student_profession'=> 'varchar(64) DEFAULT NULL',
			'student_email'=> 'varchar(128) NOT NULL',
			'student_fb_id'=> 'varchar(128) DEFAULT NULL',
			'student_contact'=> 'varchar(32) NOT NULL',
			'student_blood_group'=> 'enum("A+","A-","AB+","AB-","B+","B-","O+","O-") DEFAULT NULL',
			'student_qualification'=> 'text',
			'student_alternate_contact'=> 'text',
			'student_reason_of_photography'=> 'text',
			'student_expectation'=> 'text',
			'student_pk'=> 'bigint(20) NOT NULL AUTO_INCREMENT',
			'PRIMARY KEY (student_pk)',
			'UNIQUE KEY student_id (student_id)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{student}}');
	}
}