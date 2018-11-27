<?php
$this->breadcrumbs=array(
	Yii::t('core','Section')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List BatchSection','url'=>array('index')),
	array('label'=>'Create BatchSection','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('batch-section-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Section')?></h1>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('batchSection/create'),
)); ?>
&nbsp;

<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'batch-section-grid',
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
		'id',
		
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id')),
		//'batch_group_id',
		/*
		 array(
		'name'=>'batch_group_id',
		'value'=>'BatchGroup::model()->findByPk($data->batch_group_id)->group_name',
		'filter'=>CHtml::listData(BatchGroup::model()->findAll(),'batch_id','group_name')
		),*/
		'batch_group_id'=>array('type'=>'raw','name'=>'batch_group_id','value'=>'$data->batchgroup->group_name." (". $data->batchgroup->id .")"','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		'section_name',
		'start_role',
		'end_role',
		'session_id',
		/*
		'course_id',
		'department_id',
		
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>

<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('batchSection/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("batch-section-grid");
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

