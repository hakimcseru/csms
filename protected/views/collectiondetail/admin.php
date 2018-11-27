<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Details')=>array('index'),
	Yii::t('core','Manage Student Collection Details'),
);

$this->menu=array(
	array('label'=>'List StudentCollectionDetail','url'=>array('index')),
	array('label'=>'Create StudentCollectionDetail','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-collection-detail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Student Collection Details') ?></h1>


<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('collectiondetail/create'),
)); ?>
&nbsp;
<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-collection-detail-grid',
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
		//'student_pk',
		'session_id',
		'student_id',
		
		array(
		'name'=>'collection_amount',
		'type'=>'raw',
		
		//'footer'=>$model->getTotalss('collection_amount',$model->search()->getKeys()),
		//'footer'=>$model->getTotalss('collection_amount',$model->search()->getKeys()),		
		'footer'=>$model->totalsee('collection_amount'),
		//totalsee
				
		),
		
		'comment',
		'collection_date',
		'deposite_date',
		'bank_id',
		/*
		'collection_type',
		'bank_id',
		'course_id',
		'year',
		'month',
		'collection_for',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('collectiondetail/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-collection-detail-grid");
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

