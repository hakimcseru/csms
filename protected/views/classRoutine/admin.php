<?php
$this->breadcrumbs=array(
	Yii::t('core','Class Routines')=>array('admin'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List ClassRoutine','url'=>array('index')),
	array('label'=>'Create ClassRoutine','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('class-routine-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Class Routine')?></h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('classRoutine/create'),
)); ?>
&nbsp;


<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'class-routine-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'session_id',
	
		//'course_id',
		array('name'=>'course_id','value'=>'$data->course_id?$data->course->course_name:null','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),),

		//'department_id',
			array('name'=>'department_id','value'=>'$data->department_id?$data->department->department_name:null','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name'),),
		//'batch_id',
		array('name'=>'batch_id','value'=>'$data->batch_id?$data->batch->batch_id:null','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_pk','batch_id'),),
		
		'batch_group_id'=>array('type'=>'raw','name'=>'batch_group_id','value'=>'$data->batch_group_id?$data->batchgroup->group_name." (". $data->batchgroup->id .")":null','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'id','group_name')),
		//'batch_group_id',
		//'batch_section_id',
		array('name'=>'batch_section_id','value'=>'$data->sescion?$data->sescion->section_name:null','filter'=>CHtml::listData(BatchSection::model()->findAll(array('order'=>'section_name')),'id','section_name'),),
		//'faculty_member_id',
		array('name'=>'faculty_member_id','value'=>'$data->faculty_member_id?$data->facultyMember->member_name:null','filter'=>CHtml::listData(FacultyMember::model()->findAll(array('order'=>'member_name')),'member_pk','member_name'),),
		//'room_id',
			array('name'=>'room_id','value'=>'$data->room_id?$data->room->room_no:null','filter'=>CHtml::listData(Room::model()->findAll(array('order'=>'room_no')),'room_pk','room_no'),),
			array('name'=>'class_period_id','value'=>'$data->class_period_id?$data->classPeriod->name:null','filter'=>CHtml::listData(ClassPeriod::model()->findAll(array('order'=>'name')),'id','name'),),
		//'class_period_id',
	
		//'additional_faculty_member_id',
		array('name'=>'additional_faculty_member_id','value'=>'$data->additional_faculty_member_id?$data->A_facultyMember->member_name:null','filter'=>CHtml::listData(FacultyMember::model()->findAll(array('order'=>'member_name')),'member_pk','member_name'),),
		
		'weekday',
		
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
