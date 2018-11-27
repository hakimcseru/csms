<?php
$this->breadcrumbs=array(
	'Student Fines'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StudentFine','url'=>array('index')),
	array('label'=>'Create StudentFine','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-fine-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Student Fines');?></h1>




<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-fine-grid',
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
		array('name'=>'student_id','value'=>'Bndate::BanglaNumDate($data->student_id)'),
		array('name'=>'student_id','value'=>'$data->students->student_name','filter'=>false),
		array('name'=>'month','value'=>'Bndate::BanglaNumMonth($data->month)','filter'=>Bndate::BanglaNumMonthArray(),),
array('name'=>'session_id','value'=>'Bndate::BanglaNumDate($data->session_id)'),
array('header'=>'Course','value'=>'$data->studentsenrollment?$data->studentsenrollment->course->course_name:""','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),),
		
		
		array('header'=>'Departmet','value'=>'$data->studentsenrollment?$data->studentsenrollment->department->department_name:""','filter'=>false),
		
		array('header'=>'Batch','value'=>'$data->studentsenrollment?$data->studentsenrollment->batch->batch_id:""','filter'=>false),
		

array('header'=>'Batch Group','value'=>'$data->studentsenrollment?$data->studentsenrollment->batchgroup->group_name:""','filter'=>false),
		
		array('header'=>'Semester','value'=>'$data->studentsenrollment?$data->studentsenrollment->semesterLevel->lebel:""','filter'=>false),
		
		array('header'=>'Roll','value'=>'$data->studentsenrollment?Bndate::BanglaNumDate($data->studentsenrollment->roll_no):""','filter'=>false),
		
		//array('header'=>'','value'=>'$data->students->student_name','filter'=>false),
		
		//'collection_id',
	
		array('name'=>'amount','value'=>'Bndate::BanglaNumDate($data->amount)'),
		'comment',
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>

<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('studentFine/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-fine-grid");
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