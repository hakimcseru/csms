<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	Yii::t('core','Manage'),
);
$active = 'manage';
$this->renderPartial('_menu', array('active'=>$active));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Students')?></h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('student/create'),
)); ?>
&nbsp;

<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'student-grid',
	'dataProvider'=>$model->search(),
        'template'=>"{pager}{summary}\n{items}\n{summary}{pager}",
	'filter'=>$model,
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

			'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'student_name',
		

		array('name'=>'student_image',
		'value'=>'$data->student_image?CHtml::image( $data->getStImage($data->student_image),"",array(\'width\'=>30, \'height\'=>45)):""','type'=>'raw',
		'filter'=>array("Yes"=>'Yes',"No"=>"No"),
		),
		/*
		array('name'=>'session_id','value'=>'$data->EnrollmentInfoLast?$data->EnrollmentInfoLast->session:""','filter'=>CHtml::listData(StudentEnrollmentInfo::model()->findAll(array('order'=>'session')),'session','session'),),
		
		array('name'=>'batch_ref_course_pk','value'=>'$data->EnrollmentInfoLast?$data->EnrollmentInfoLast->course->course_name:""','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_name','course_name'),),

		array('name'=>'department_id','value'=>'$data->EnrollmentInfoLast?$data->EnrollmentInfoLast->department->department_name:""','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'department_name','department_name'),),

		'student_ref_batch_pk'=>array('name'=>'student_ref_batch_pk','value'=>'$data->EnrollmentInfoLast?$data->EnrollmentInfoLast->batch->batch_id:""','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),
		
		//array('name'=>'batch_group','value'=>'$data->EnrollmentInfo->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),
		
		'batch_group'=>array('type'=>'raw','name'=>'batch_group','value'=>'($data->EnrollmentInfoLast && $data->EnrollmentInfoLast->batchgroup)?$data->EnrollmentInfoLast->batchgroup->group_name." (". $data->EnrollmentInfoLast->batchgroup->id .")":""','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		
		//array('name'=>'EnrollmentInfoLast.semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->EnrollmentInfoLast->course_id,$data->EnrollmentInfoLast->semester)','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),

		array('name'=>'semester','value'=>'($data->EnrollmentInfoLast && $data->EnrollmentInfoLast->semesterLevel)?$data->EnrollmentInfoLast->semesterLevel->lebel:""','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel'),),
		'roll_no'=>array('name'=>'roll_no','value'=>'Bndate::t($data->EnrollmentInfoLast->roll_no)'),*/


//'student_father_name',
		//'student_mother_name',
		//'student_present_address',
		//'student_permanent_address',
		//'student_nationality',
		//'student_gender',
		//'student_dob',
		//'student_pob',
		//'student_profession',
		//'student_email',
		//'student_fb_id',
		//'student_contact',
		//'student_blood_group',
		//'student_qualification',
		//'student_alternate_contact',
		//'student_reason_of_photography',
		//'student_expectation',
		//'student_pk',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('student/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-grid");
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
<td><a class="btn btn-primary btnPrint" style="margin-right:20px;" href="#" onclick="getUrl(this)" >Excel Export</a></td>