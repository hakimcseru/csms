<?php

class m120301_120344_create_course_subject_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{course_subject}}', array(
			'course_subject_pk'=> 'bigint(20) NOT NULL AUTO INCREMENT',
			'course_subject_ref_course_pk'=> 'bigint(20) NOT NULL',
			'course_subject_ref_subject_pk'=> 'bigint(20) NOT NULL',
			'course_subject_semester_no'=>'INT(4) DEFAULT 1',
			'PRIMARY KEY (course_subject_pk)',
			'UNIQUE KEY (course_subject_ref_course_pk, course_subject_ref_subject_pk)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('reference_course_subject_ref_course_pk', '{{course_subject}}', 'course_subject_ref_course_pk', '{{course}}', 'course_pk', 'CASCADE', 'CASCADE');
		$this->addForeignKey('reference_course_subject_ref_subject_pk', '{{course_subject}}', 'course_subject_ref_subject_pk', '{{subject}}', 'subject_pk', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('reference_course_subject_ref_course_pk', '{{course_subject}}');
		$this->dropForeignKey('reference_course_subject_ref_subject_pk', '{{course_subject}}');
		$this->dropTable('{{course_subject}}');
	}
}