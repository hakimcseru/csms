<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Enrollment Infos')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List StudentEnrollmentInfo','url'=>array('index')),
	array('label'=>'Create StudentEnrollmentInfo','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-enrollment-info-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Student Communication');?></h1>

&nbsp;
<?php echo CHtml::link(Yii::t('core','Advamced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search2',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-enrollment-info-grid',
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
	
	
		array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		array('header'=>'Name','value'=>'$data->student->student_name'),
		array('header'=>'Email','value'=>'$data->student->student_email'),
		array('header'=>'Contact','value'=>'$data->student->student_contact'),
		
		array('header'=>'Present Address','value'=>'$data->student->student_present_address'),
		array('header'=>'Permanent Address','value'=>'$data->student->student_permanent_address'),
		array('header'=>'Blood Group','value'=>'$data->student->student_blood_group'),
		
		array('header'=>'Roll','value'=>'Bndate::t($data->roll_no)'),
	
	
		
		
		
		/*array('name'=>'student.student_image',
		'value'=>'$data->student->student_image?CHtml::image( $data->student->getStImage($data->student->student_image),"",array(\'width\'=>30, \'height\'=>45)):""','type'=>'raw',
		
		),
		
			'session'=>array('name'=>'session','value'=>'Bndate::t($data->session)'),
		'course_id'=>array('name'=>'course_id','value'=>'$data->course->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_name','course_name')),
		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'department_name','department_name')),
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id')),
		'batch_group'=>array('type'=>'raw','name'=>'batch_group','value'=>'$data->batchgroup->group_name." (". $data->batchgroup->id .")"','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		//'semester'=>array('name'=>'semester','value'=>CourseSemesterLebel::model()->find('semester_id='.'$data->semester')->lebel),
		'semester'=>array('name'=>'semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course_id,$data->semester,1)','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel')),
		
		array(
			'name'=>'enrollment_status',
			'filter'=>array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি','Reexam'=>'মানোন্নয়ন'),
		),
		'roll_no'=>array('name'=>'roll_no','value'=>'Bndate::t($data->roll_no)'),

		'admission_reference',*/


		//'total_deposit'=>array('name'=>'total_deposit','value'=>'Bndate::t($data->total_deposit)'),
		/*
		'deposit_date',
		'input_datetime',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'',//{reprocess}
			'buttons'=>array (
			'studentinfo' => array (
			    'label'=>'তথ্য',
			    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("student/update", array("id"=>$data->student_pk))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			'reprocess' => array (
			    'label'=>'পুনঃপ্রক্রিয়া',
			    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("collection/allStudentProcess", array("id"=>$data->student_id,"year"=>$data->session))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			/*
			'marksheet' => array (
			    'label'=>'Mark Sheet',
			    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("studentEnrollmentInfo/tabulation", array("id"=>$data->id))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),*/
			'tabulation' => array (
			    'label'=>'Tebulation',
			    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
			    'url'=>'Yii::app()->createUrl("studentEnrollmentInfo/tebulation", array("id"=>$data->id))',
			    'visible' => '1',
			   // "options" => array(
			   //     "class" => "delete_contact"
			   // )
			),
			),
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl123(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('studentEnrollmentInfo/exportCommunication'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-enrollment-info-grid");
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
<td><a class="btn btn-primary btnPrint" style="margin-right:20px;"  href="#" onclick="getUrl123(this)" >Excel Export</a></td>



