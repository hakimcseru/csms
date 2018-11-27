<?php

class m120220_120610_create_faculty_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{faculty}}', array(
			'faculty_id'=> 'varchar(16) NOT NULL',
			'faculty_name'=> 'varchar(128) NOT NULL',
			'faculty_father_name'=> 'varchar(128) NULL',
			'faculty_mother_name'=> 'varchar(128) NULL',
			'faculty_present_address'=> 'text NOT NULL',
			'faculty_permanent_address'=> 'text NOT NULL',
			'faculty_nationality'=> 'varchar(32) NOT NULL',
			'faculty_gender'=> 'enum("MALE","FEMALE") NOT NULL',
			'faculty_dob'=> 'date NOT NULL',
			'faculty_email'=> 'varchar(128) NOT NULL',
			'faculty_contact'=> 'varchar(32) NOT NULL',
			'faculty_blood_group'=> 'enum("A+","A-","AB+","AB-","B+","B-","O+","O-") DEFAULT NULL',
			'faculty_portfolio'=> 'text NULL',
			'faculty_current_works'=> 'text NULL',
			'faculty_achievement'=> 'text NULL',
			'faculty_origin_of_award'=> 'text NULL',
			'faculty_joining_date'=> 'date NOT NULL',
			'faculty_contract_paper'=> 'varchar(128) NULL',
			'faculty_pk'=> 'bigint(20) NOT NULL AUTO_INCREMENT',
			'PRIMARY KEY (faculty_pk)',
			'UNIQUE KEY faculty_id (faculty_id)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{faculty}}');
	}
}