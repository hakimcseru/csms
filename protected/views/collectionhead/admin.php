<?php
$this->breadcrumbs=array(
	Yii::t('core','Collection Heads')=>array('index'),
	Yii::t('core','Manage Collection Heads'),
);

$this->menu=array(
	array('label'=>'List CollectionHead','url'=>array('index')),
	array('label'=>'Create CollectionHead','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('collection-head-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Collection Heads') ?></h1>


<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('collectionHead/create'),
)); ?>


<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'collection-head-grid',
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
		'session',
                'apply_on_month',
		
             array(
		'name'=>'head_group_id',
		'value'=>'StudentCollectionGroup::model()->findByPk($data->head_group_id)->group_name',
		'filter'=>CHtml::listData(StudentCollectionGroup::model()->findAll(),'id','group_name')
		),
		
		
           array(
		'name'=>'course',
		'value'=>'Course::model()->findByPk($data->course)->course_name',
		'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name')
		),
		
            array(
		'name'=>'student_type',
		
		'filter'=>array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি','Reexam'=>'মানোন্নয়ন')
		),
		
		
		'collection_amount',
		/*'purpose',
		'active',*/
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('collectionhead/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("collection-head-grid");
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

