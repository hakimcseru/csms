<?php

class m120223_114934_create_certificate_record_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{certificate_record}}', array(
			'certificate_record_ref_student_pk'=> 'bigint(20) NOT NULL',
			'certificate_record_received'=> 'text',
			'certificate_record_distributed'=> 'text',
			'certificate_record_last_updated_on'=> 'datetime DEFAULT NULL',
			'UNIQUE KEY unique_certificate_record_ref_student_pk (certificate_record_ref_student_pk)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('reference_certificate_record_ref_student_pk', '{{certificate_record}}', 'certificate_record_ref_student_pk',
				'{{student}}', 'student_pk', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('reference_certificate_record_ref_student_pk', '{{certificate_record}}');

		$this->dropTable('{{certificate_record}}');
	}
}