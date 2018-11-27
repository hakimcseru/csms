<?php
$this->breadcrumbs=array(
	'Exam Routine Dates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ExamRoutineDate','url'=>array('index')),
	array('label'=>'Create ExamRoutineDate','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('exam-routine-date-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Exam Routine Dates</h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('examRoutineDate/create'),
)); ?>
&nbsp;

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'exam-routine-date-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'exam_routine_id',
		'exam_date',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
