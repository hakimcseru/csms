<?php
$this->breadcrumbs=array(
	'Bexam Routine Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BexamRoutineGroup','url'=>array('index')),
	array('label'=>'Create BexamRoutineGroup','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bexam-routine-group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Exam Routine Groups</h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('bexamRoutineGroup/create'),
)); ?>
&nbsp;


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'bexam-routine-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_name',
		'session_id',
		
		'course_id'=>array('name'=>'course_id','value'=>'$data->course->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_name','course_name')),
		
		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'department_name','department_name')),
		
		'batch_group_id'=>array('type'=>'raw','name'=>'batch_group_id','value'=>'$data->batch_group->group_name." (". $data->batch_group->id .")"','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		'semester'=>array('name'=>'semester','value'=>'$data->semester?CourseSemesterLebel::model()->semesterLebel($data->course_id,$data->semester,1):""','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel')),
		
		'start_role',
		'end_role',
		
		
		
		/*
		'department_id',
		'batch_id',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
