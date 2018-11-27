<?php

class m120315_065055_alter_class_table_add_semester_column extends EDbMigration
{
	public function up()
	{
		$this->addColumn('{{class}}', 'class_semester', 'INTEGER NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('{{class}}', 'class_semester');
	}
}