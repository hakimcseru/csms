<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collections')=>array('index'),
	
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List StudentCollection','url'=>array('index')),
	array('label'=>'Create StudentCollection','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-collection-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Student Collections') ?></h1>

<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-collection-grid',
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
		'collection_detail_id',
		//'student_pk',
		//'student_id',
		array('name'=>'student_id','value'=>'$data->student_id','type'=>"raw"),
		'collection_id',
		array(
		'name'=>'collection_amount',
		'type'=>'raw',
		'footer'=>$model->getTotalss('collection_amount',$model->search()->getKeys()), 
				
		),
		
		'comment',
		'session_id',
		/*
		'collection_date',
		'collection_type',
		'bank_id',
		'deposite_date',
		
		'course_id',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('collection/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-collection-grid");
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
