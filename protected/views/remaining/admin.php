<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Remaining')=>array('index'),
	Yii::t('core','Manage Student Remaining'),
);

$this->menu=array(
	array('label'=>'List StudentRemaining','url'=>array('index')),
	array('label'=>'Create StudentRemaining','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-remaining-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Student Remaining')?></h1>


<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-remaining-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
	'columns'=>array(
		'id',
		'student_pk',
		//'student_id',
		array('name'=>'student_id','value'=>'$data->students->student_name','filter'=>CHtml::listData(Student::model()->findAll(array('order'=>'student_name')),'student_name','student_name'),),
		'remaining_amount',
		'description',
		'session_id',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('remaining/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-remaining-grid");
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
