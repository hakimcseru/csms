<?php

class m120321_110149_rename_calender_end_time_column extends EDbMigration
{
	public function up()
	{
		$this->renameColumn('{{calendar}}', 'calender_end_time', 'calendar_end_time');
	}

	public function down()
	{
		$this->renameColumn('{{calendar}}', 'calendar_end_time', 'calender_end_time');
	}
}