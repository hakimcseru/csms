<?php

class m120301_080009_create_course_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{course}}', array(
			'course_pk'=>  'bigint(20) NOT NULL AUTO_INCREMENT',
			'course_name'=> 'varchar(128) NOT NULL',
			'PRIMARY KEY (course_pk)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{course}}');
	}
}