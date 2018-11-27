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
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'session_id'=>array('name'=>'session_id','value'=>'Bndate::t($data->session_id)','filter'=>CHtml::listData(SavedResult::model()->findAll(array('order'=>'session_id')),'session_id','session_id')),
		'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'name',
		
		'course'=>array('name'=>'course','value'=>'$data->course','filter'=>CHtml::listData(SavedResult::model()->findAll(array('order'=>'course')),'course','course')),
		
		'department'=>array('name'=>'department','value'=>'$data->department','filter'=>CHtml::listData(SavedResult::model()->findAll(array('order'=>'department')),'department','department')),
		
		'semester'=>array('name'=>'semester','value'=>'$data->semester','filter'=>CHtml::listData(SavedResult::model()->findAll(array('order'=>'semester')),'semester','semester')),

		'batch_group'=>array('name'=>'batch_group','value'=>'$data->batch_group','filter'=>CHtml::listData(SavedResult::model()->findAll(array('order'=>'batch_group')),'batch_group','batch_group')),
		
		'roll_no',
		
		
		
		
		'total_number'=>array('name'=>'total_number','value'=>'Bndate::t($data->total_number)'),
		'result',
		//'result'=>array('name'=>'result','value'=>'$data->result','filter'=>CHtml::listData(SavedResult::model()->findAll(array('order'=>'result')),'result','result')),
		
		'position'=>array('name'=>'position','value'=>'Bndate::t($data->position)'),
		/*'published_date',
		'saved_date',*/
		
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view} {update} {marksheet} {delete} ',//{reprocess}
			'buttons'=>array (
			
			'marksheet' => array (
			    //'label'=>'Re Process',
			    'imageUrl'=>Yii::app()->request->baseUrl.'/images/tabulation.gif',
			    'url'=>'Yii::app()->createUrl("savedResult/PrintmarksheetSingle", array("id"=>$data->id))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			
			),
		),
	),
)); ?>
