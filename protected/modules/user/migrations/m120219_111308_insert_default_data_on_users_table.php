<?php

class m120219_111308_insert_default_data_on_users_table extends EDbMigration
{
	public function safeUp()
	{
		$this->insert('{{users}}', array(
			'id'=>1,
			'username'=>'admin',
			'password'=>'21232f297a57a5a743894a0e4a801fc3',
			'email'=>'webmaster@example.com',
			'activkey'=>'9a24eff8c15a6a141ece27eb6947da0f',
			'createtime'=>1261146094,
			'lastvisit'=>0,
			'superuser'=>1,
			'status'=>1,
		));

		$this->insert('{{users}}', array(
			'id'=>2,
			'username'=>'demo',
			'password'=>'fe01ce2a7fbac8fafaed7c982a04e229',
			'email'=>'demo@example.com',
			'activkey'=>'099f825543f7850cc038b90aaff39fac',
			'createtime'=>1261146096,
			'lastvisit'=>0,
			'superuser'=>0,
			'status'=>1,
		));
	}

	public function safeDown()
	{
		$this->delete('{{users}}', 'id<3');
	}
}