<?php
$this->breadcrumbs=array(
	'Attendance Release Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AttendanceReleaseSetting','url'=>array('index')),
	array('label'=>'Create AttendanceReleaseSetting','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('attendance-release-setting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Attendance Release Settings</h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('attendanceReleaseSetting/create'),
)); ?>
&nbsp;

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'attendance-release-setting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'session',
		'course_id',
		'min_allendance',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
