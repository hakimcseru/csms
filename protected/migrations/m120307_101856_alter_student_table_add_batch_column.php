<?php

class m120307_101856_alter_student_table_add_batch_column extends EDbMigration
{
	public function up()
	{
		$this->addColumn('{{student}}', 'student_ref_batch_pk', 'BIGINT NULL');
		$this->createIndex('index_student_ref_batch_pk', '{{student}}', 'student_ref_batch_pk');
	}

	public function down()
	{
		$this->dropIndex('index_student_ref_batch_pk', '{{student}}');
		$this->dropColumn('{{student}}', 'student_ref_batch_pk');
	}
}