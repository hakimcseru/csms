<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List Batch','url'=>array('index')),
	array('label'=>'Create Batch','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('batch-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Batch')." ".Yii::t('core','Manage');?></h1>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('batch/create'),
)); ?>



<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'batch-grid',
	'dataProvider'=>$model->search(),
	 'template'=>"{pager}{summary}\n{items}\n{summary}{pager}",
         'pager'=>array(
'header'=>'',
'cssFile'=>false,
'maxButtonCount'=>17,


'firstPageLabel'=>'<<',
'lastPageLabel'=>'>>',
'prevPageLabel'=>'<',
'nextPageLabel'=>'>',
),
	'filter'=>$model,
	'columns'=>array(
		//'batch_pk'=>array('name'=>'batch_pk','value'=>'Bndate::t($data->batch_pk)'),


		'batch_id'=>array('name'=>'batch_id','value'=>'Bndate::t($data->batch_id)', 'filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),
		'batch_start_date'=>array('name'=>'batch_start_date','value'=>'Bndate::t($data->batch_start_date)'),
		'batch_end_date'=>array('name'=>'batch_end_date','value'=>'Bndate::t($data->batch_end_date)'),

		'batch_status'=>array('name'=>'batch_status','value'=>'Yii::t("core",$data->batch_status)', 'filter'=>CHtml::listData(Batch::model()->getBatchStatus(), 'id', 'title'),),

		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name', 'filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'id')),'id','department_name'),),
		'batch_ref_course_pk'=>array('name'=>'batch_ref_course_pk','value'=>'$data->course->course_name', 'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_pk')),'course_pk','course_name'),),
		/*
		'batch_ref_course_name',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('batch/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("batch-grid");
		pos = queryString.indexOf('?',0)
		if(pos == -1)
		{
			queryString = '';
		}
		else
		{
			queryString = queryString.substr(pos);
		}
		$(link).attr("href", baseUrl+queryString);
		//alert($.fn.yiiGridView.getUrl("attendance-final-data-grid"));
	}      
</script>
<td><a class="btn btn-primary" style="margin-right:20px;"  class="btnPrint" href="#" onclick="getUrl(this)" ><?php echo Yii::t('core','Excel Export');?></a></td>

