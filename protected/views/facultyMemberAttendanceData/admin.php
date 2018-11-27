<?php
$this->breadcrumbs=array(
	'Faculty Member Attendance Datas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FacultyMemberAttendanceData','url'=>array('index')),
	array('label'=>'Create FacultyMemberAttendanceData','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faculty-member-attendance-data-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Faculty Member Attendance </h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'faculty-member-attendance-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'member_id'=>array('name'=>'member_id', 'value'=>'$data->fm->member_name'),
		'fm_reg_no',
		'date',
		'time',
		array('name'=>'weekday','value'=>'Bndate::t(date("l", strtotime($data->date))) ','filter'=>array('Saturday'=>'Saturday','Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday')
                    ),
		/*
		'note',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
