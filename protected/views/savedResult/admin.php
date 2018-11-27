<?php
$this->breadcrumbs=array(
	'Saved Results'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SavedResult','url'=>array('index')),
	array('label'=>'Create SavedResult','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('saved-result-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Saved Results</h1>




<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'saved-result-grid',
	'dataProvider'=>$model->search3(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		
		'session_id',
		'course',
		'department',
		'semester',
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id'),
		'batch_group',
		
		
		/*'roll_no',
		'name',
		'student_id',
		'total_number',
		'result',
		'position',
		'published_date',
		'saved_date',*/
		
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view} {print} {marksheet} {excel} {delete} ',//{reprocess}
			'buttons'=>array (
			
			
			'excel' => array (
			    //'label'=>'Re Process',
			    'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
			    'url'=>'Yii::app()->createUrl("/savedResult/excelTabulation", array("batch_id"=>$data->batch_id,"session_id"=>$data->session_id,"course"=>$data->course,"department"=>$data->department,"semester"=>$data->semester,"batch_group"=>$data->batch_group))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			
			'marksheet' => array (
			    //'label'=>'Re Process',
			    'imageUrl'=>Yii::app()->request->baseUrl.'/images/marksheet.png',
			    'url'=>'Yii::app()->createUrl("savedResult/marksheet2", array("batch_id"=>$data->batch_id,"session_id"=>$data->session_id,"course"=>$data->course,"department"=>$data->department,"semester"=>$data->semester,"batch_group"=>$data->batch_group))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			'delete' => array (
			    //'label'=>'Re Process',
			    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("savedResult/delete", array("batch_id"=>$data->batch_id,"session_id"=>$data->session_id,"course"=>$data->course,"department"=>$data->department,"semester"=>$data->semester,"batch_group"=>$data->batch_group))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			
			'view' => array (
			    //'label'=>'Re Process',
			    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("savedResult/savedTabulation", array("batch_id"=>$data->batch_id,"session_id"=>$data->session_id,"course"=>$data->course,"department"=>$data->department,"semester"=>$data->semester,"batch_group"=>$data->batch_group))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			
			'print' => array (
			    'label'=>'Print',
			    'imageUrl'=>Yii::app()->request->baseUrl.'/images/print.png',
			    'url'=>'Yii::app()->createUrl("/savedResult/printTabulation", array("batch_id"=>$data->batch_id,"session_id"=>$data->session_id,"course"=>$data->course,"department"=>$data->department,"semester"=>$data->semester,"batch_group"=>$data->batch_group))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			/*
			'tabulation' => array (
			    'label'=>'Tebulation',
			    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("studentEnrollmentInfo/tebulation", array("id"=>$data->id))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),*/
			),
		),
	),
)); ?>
