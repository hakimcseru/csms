<?php
$this->breadcrumbs=array(
	Yii::t('core','Rooms')=>array('index'),
	Bndate::t($model->room_pk),
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
	array('label'=>'Create Room','url'=>array('create')),
	array('label'=>'Update Room','url'=>array('update','id'=>$model->room_pk)),
	array('label'=>'Delete Room','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->room_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Room','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Rooms')?> #<?php echo Bndate::t($model->room_pk); ?></h1>

<?php
$this->renderPartial('_view', array('model' => $model));

$this->widget('application.widgets.calendar.MonthlyCalendar', array(
	'roomNo'=> $model->room_pk,
	'date'=> $month,
	//'startTime'=> '08:00',
	//'endTime'=> '16:00',
));
?>