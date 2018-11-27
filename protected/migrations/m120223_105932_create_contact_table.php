<?php

class m120223_105932_create_contact_table extends EDbMigration
{
	public function up()
	{
		$this->createTable('{{contact}}', array(
			'contact_pk'=> 'bigint(20) NOT NULL AUTO_INCREMENT',
			'contact_type'=> 'enum("AFFILIATED","LOGISTICAL","THIRD_PARTY") NOT NULL',
			'contact_name'=> 'varchar(128) NOT NULL',
			'contact_organization'=> 'varchar(128) DEFAULT NULL',
			'contact_email'=> 'varchar(128) DEFAULT NULL',
			'contact_phone'=> 'varchar(32) DEFAULT NULL',
			'contact_address'=>' text',
			'contact_mou'=> 'text',
			'PRIMARY KEY (contact_pk)',
		),'ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('{{contact}}');
	}
}