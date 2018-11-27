<?php
$this->breadcrumbs=array(
	Yii::t('core','Calendar'),
);

$this->menu=array(
	array('label'=>'Create Calendar','url'=>array('create')),
	array('label'=>'Manage Calendar','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Calendar') ?></h1>

<?php $this->widget('application.widgets.calendar.MonthlyCalendar', array(
	//'roomNo'=> $model->room_pk,
	'date'=> $month,
	//'startTime'=> '08:00',
	//'endTime'=> '16:00',
)); ?>
