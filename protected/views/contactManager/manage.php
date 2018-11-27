<?php
$this->breadcrumbs=array(
	Yii::t('core','Manage Contacts'),
);
$this->renderPartial('_menu', array('active'=>'manage'));
?>

<h1><?php echo Yii::t('core','Manage Contacts') ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'contact-manager-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'contact_pk',
		array(
			'name'=> 'contact_type',
			'filter'=> $model->enumContactType,
		),
		'contact_name',
		'contact_organization',
		'contact_email',
		'contact_phone',
		//'contact_address',
		//'contact_mou',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
