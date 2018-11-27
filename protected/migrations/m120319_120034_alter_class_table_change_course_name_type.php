<?php

class m120319_120034_alter_class_table_change_course_name_type extends EDbMigration
{
	public function up()
	{
		$this->alterColumn('{{class}}', 'class_ref_subject_name', 'VARCHAR(128) NULL');
	}

	public function down()
	{
		
	}
}