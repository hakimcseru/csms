<?php
$this->breadcrumbs=array(
	'Saved Result Subjects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SavedResultSubject','url'=>array('index')),
	array('label'=>'Create SavedResultSubject','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('saved-result-subject-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Saved Result Subjects</h1>

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

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'saved-result-subject-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'saved_result_id',
		'subject_id',
		'subject_code',
		'subject_name',
		'subject_full_mark',
		/*
		'student_subject_marks',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
