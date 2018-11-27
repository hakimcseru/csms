<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Subject')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List CourseSubject','url'=>array('index')),
	array('label'=>'Create CourseSubject','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-subject-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Course Subject');?></h1>


<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-subject-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(
		'name'=>'course_subject_ref_course_pk',
		'value'=>'$data->course->course_name',
		'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_pk')),'course_pk','course_name'),
		),
		array(
		'name'=>'course_subject_ref_subject_pk',
		'value'=>'$data->subject->subject_name',
		'filter'=>CHtml::listData(Subject::model()->findAll(array('order'=>'subject_pk')),'subject_pk','subject_name'),

		),
		array(
		'name'=>'course_subject_semester_no',
		'value'=>'Bndate::t($data->course_subject_semester_no)'
		),

		array(
		'name'=>'course_subject_department_id',
		'value'=>'$data->department->department_name',
		'filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'id')),'id','department_name'),
		),



		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
