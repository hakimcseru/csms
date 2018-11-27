<?php
$this->breadcrumbs=array(
	'Class Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClassModel','url'=>array('index')),
	array('label'=>'Create ClassModel','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('class-model-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Class Models</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'class-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'class_pk',
		'class_ref_room_pk',
		'class_ref_room_no',
		'class_start_date',
		'class_end_date',
		'class_start_time',
		/*
		'class_end_time',
		'class_status',
		'class_days_on_week',
		'class_ref_batch_pk',
		'class_ref_batch_id',
		'class_ref_subject_pk',
		'class_ref_subject_name',
		'class_semester',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
