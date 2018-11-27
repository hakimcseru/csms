<?php

$this->menu=array(
	array('label'=>'Contact Manager', 'itemOptions'=>array('class'=>'nav-header')),
	array('label'=>'Manage Contacts', 'icon'=>'cog', 'url'=>array('manage'), 'active'=>($active == 'manage')? true : false),
	array('label'=>'Add New Contact', 'icon'=>'plus', 'url'=>array('create'), 'active'=>($active == 'create')? true : false),
);
?>
