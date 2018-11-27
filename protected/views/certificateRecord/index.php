<?php
$this->breadcrumbs=array(
	Yii::t('core','Manage Certificate Records'),
);

$this->menu=array(
	array('label'=>'Create CertificateRecord','url'=>array('create')),
	array('label'=>'Manage CertificateRecord','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Certificate Records')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
