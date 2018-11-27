<?php
$this->breadcrumbs=array(
	'Student Results'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StudentResult','url'=>array('index')),
	array('label'=>'Create StudentResult','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-result-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Student Results</h1>




<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-result-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'session'=>array('name'=>'session','value'=>'Bndate::t($data->session)'),
		'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'student_pk'=>array('name'=>'student_pk','value'=>'$data->student->student_name'),
		'course'=>array('name'=>'course','value'=>'$data->courses->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_name','course_name')),
		'department'=>array('name'=>'department','value'=>'$data->departments->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'department_name','department_name')),
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id')),
		'batch_group'=>array('type'=>'raw','name'=>'batch_group','value'=>'$data->batchgroup->group_name." (". $data->batchgroup->id .")"','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		'semester'=>array('name'=>'semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course,$data->semester,1)','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel')),
		'subject',
		
		
		
		'full_marks',
		'result',
		
		
		
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
