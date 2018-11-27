<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Materials')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List CourseMaterial','url'=>array('index')),
	array('label'=>'Create CourseMaterial','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-material-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Course Materials')?></h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('courseMaterial/create'),
)); ?>
&nbsp;
<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->





<?php 
$models = Subject::model()->findAll();
	$data1 = array();
	foreach ($models as $model1)
    $data1[$model1->subject_pk] = $model1->subject_name . ' ('. $model1->subject_code.')';     
	

$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'course-material-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'header'=>'Sale No',
		
			'value'=>'++$row',
		),
		'session_id',
		array('name'=>'course_id','value'=>'$data->course_id?$data->course->course_name:null','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),),
		array('name'=>'department_id','value'=>'$data->department_id?$data->department->department_name:null','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name'),),
		array('name'=>'batch_id','value'=>'$data->batch_id?$data->batch->batch_id:null','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_pk','batch_id'),),
		array('type'=>'raw','name'=>'group_id','value'=>'$data->group_id?$data->batchgroup->group_name." (". $data->batchgroup->id .")":null','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		array('name'=>'subject_id','value'=>'$data->subject_id?$data->subject->subject_name." (". $data->subject->subject_code .")":null','filter'=> $data1 ),
		array('name'=>'semester_id','value'=>'$data->semester_id?$data->semesterLevel->lebel:null','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel'),),
		//'semester_id',
		'doc_title',
		'file_location',
	
		
		'doc_description',
		
		//'course_id',
	//'semester_id',
		
		/*
		'department_id',
		'subject_id',
		'group_id',
		'file_location',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
						'template'=>'{view}{update}{delete}{download}',
		'buttons'=>array
			(
				'download' => array
				(
					'label'=>'Download',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/download.png',
					//'url'=>'Yii::app()->createUrl("clients/add", array("id"=>$data->id))',
					'url'=>'Yii::app()->request->baseUrl."/files/" . $data->file_location', 
				),
				
			),
		),
	),
)); ?>
