<?php

class m120301_102103_create_subject_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{subject}}', array(
			'subject_code'=> 'varchar(16) NOT NULL',
			'subject_name'=> 'varchar(128) NOT NULL',
			'subject_pk'=> 'bigint(20) NOT NULL AUTO_INCREMENT',
			'PRIMARY KEY (subject_pk)',
			'UNIQUE KEY subject (subject_code)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{subject}}');
	}
}