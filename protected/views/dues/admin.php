<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Dues')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List StudentDues','url'=>array('index')),
	array('label'=>'Create StudentDues','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-dues-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Student Dues') ?></h1>

<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-dues-grid',
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
		//'id',
		//'student_pk',
		//'student_id',
		array('name'=>'student_id','value'=>'Bndate::BanglaNumDate($data->student_id)'),
		array('name'=>'student_id','value'=>'$data->students->student_name','filter'=>false),
		array('name'=>'month','value'=>'Bndate::BanglaNumMonth($data->month)','filter'=>Bndate::BanglaNumMonthArray(),),
array('name'=>'session_id','value'=>'Bndate::BanglaNumDate($data->session_id)'),
		array('name'=>'course_id','value'=>'$data->course->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),),
		
		array('header'=>'Departmet','value'=>'$data->studentsenrollment?$data->studentsenrollment->department->department_name:""','filter'=>false),
		
		array('header'=>'Batch','value'=>'$data->studentsenrollment?$data->studentsenrollment->batch->batch_id:""','filter'=>false),
		

array('header'=>'Batch Group','value'=>'$data->studentsenrollment?$data->studentsenrollment->batchgroup->group_name:""','filter'=>false),
		
		array('header'=>'Semester','value'=>'$data->studentsenrollment?$data->studentsenrollment->semesterLevel->lebel:""','filter'=>false),
		
		array('header'=>'Roll','value'=>'$data->studentsenrollment?Bndate::BanglaNumDate($data->studentsenrollment->roll_no):""','filter'=>false),
		
		//array('header'=>'','value'=>'$data->students->student_name','filter'=>false),
		
		//'collection_id',
	
		array('name'=>'due_amount','value'=>'Bndate::BanglaNumDate($data->due_amount)'),
		'comment',
		//array('name'=>'session_id','value'=>'$data->session_id','filter'=>CHtml::listData(Student::model()->findAll(array('order'=>'student_name')),'student_name','student_name'),),
		
		//'due_date',
		
		//'year',
		//'month',
		//'month',
		
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('dues/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-dues-grid");
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

