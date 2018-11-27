<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Semester Lebel')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List CourseSemesterLebel','url'=>array('index')),
	array('label'=>'Create CourseSemesterLebel','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-semester-lebel-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Course Semester Lebel');?></h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('courseSemesterLebel/create'),
)); ?>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'course-semester-lebel-grid',
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
		'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_pk')),'course_pk','course_name'),
		),


		array(
		'name'=>'semester_id',
		'value'=>'Bndate::t($data->semester_id)',
		'filter'=>  CHtml::listData(CourseSemesterLebel::model()->findAll(array('order'=>'semester_id')), 'semester_id','semester_id'),

		),

		'lebel',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('courseSemesterLebel/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("course-semester-lebel-grid");
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
