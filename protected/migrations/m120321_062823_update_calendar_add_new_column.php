<?php

class m120321_062823_update_calendar_add_new_column extends EDbMigration
{
	public function up()
	{
		$this->addColumn('{{calendar}}', 'calendar_reference', 'varchar(32) NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('{{calendar}}', 'calendar_reference');
	}
}