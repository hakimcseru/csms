<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Enrollment Infos'),
);

$this->menu=array(
	array('label'=>'Create StudentEnrollmentInfo','url'=>array('create')),
	array('label'=>'Manage StudentEnrollmentInfo','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student Enrollment Infos')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
