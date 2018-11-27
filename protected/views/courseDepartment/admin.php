<?php
$this->breadcrumbs=array(
	Yii::t('core','Course').'-'.Yii::t('core','Department')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List CourseDepartment','url'=>array('index')),
	array('label'=>'Create CourseDepartment','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-department-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Course Department')?></h1>


<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('courseDepartment/create'),
)); ?>


<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'course-department-grid',
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
		
		array(
		'name'=>'course_id',
		'value'=>'Course::model()->findByPk($data->course_id)->course_name',
		'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name')
		),
		array(
		'name'=>'department_id',
		'value'=>'Department::model()->findByPk($data->department_id)->department_name',
		'filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name')
		),
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('courseDepartment/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("course-department-grid");
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
