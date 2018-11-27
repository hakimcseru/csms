<?php

class m120321_112918_add_day_and_type_column_on_calendar extends EDbMigration
{
	public function up()
	{
		$this->addColumn('{{calendar}}', 'calendar_day', 'ENUM ("SAT","SUN","MON","TUE","WED","THU","FRI") NOT NULL');
		$this->addColumn('{{calendar}}', 'calendar_type', 'varchar(16) NULL');
	}

	public function down()
	{
		$this->dropColumn('{{calendar}}', 'calendar_type');
		$this->dropColumn('{{calendar}}', 'calendar_day');
	}
}