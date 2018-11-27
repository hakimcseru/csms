<?php
$this->breadcrumbs=array(
	Yii::t('core','Manage Contacts')=>array('manage'),
	Bndate::t($model->contact_pk),
);

$this->renderPartial('_menu', array('active'=>'manage'));
?>

<h1><?php echo Yii::t('core','View Contact')?>&nbsp;<?php echo Bndate::t($model->contact_pk); ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'contact_pk',
		'contact_type',
		'contact_name',
		'contact_organization',
		'contact_email',
		'contact_phone',
		array(
			'name'=>'contact_address',
			'value'=> nl2br($model->contact_address),
			'type'=> 'html',
		),
		array(
			'name'=>'contact_mou',
			'value'=> nl2br($model->contact_mou),
			'type'=> 'html',
		),
	),
)); ?>
