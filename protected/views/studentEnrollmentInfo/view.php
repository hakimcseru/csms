<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Enrollment Infos')=>array('index'),
	Bndate::t($model->student_id),
);

$this->menu=array(
	array('label'=>'List StudentEnrollmentInfo','url'=>array('index')),
	array('label'=>'Create StudentEnrollmentInfo','url'=>array('create')),
	array('label'=>'Update StudentEnrollmentInfo','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentEnrollmentInfo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentEnrollmentInfo','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student Enrollment Infos'); ?> <?php echo Bndate::t($model->student_id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		
		
		
			array(
					'name'=>'student_id',
					'type'=> 'html',
					'value'=> nl2br(Bndate::t($model->student_id)),
			),
		
		'student.student_name',
		
			array(
					'name'=>'session',
					'type'=> 'html',
					'value'=> nl2br(Bndate::t($model->session)),
			),
		
			array(
								'name'=>'enrollment_status',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$model->enrollment_status)),
						),
						
		'admission_reference',	
		
			array(
					'name'=>'course_id',
					'type'=> 'html',
					'value'=> nl2br($model->course->course_name),
			),
			array(
					'name'=>'department_id',
					'type'=> 'html',
					'value'=> nl2br($model->department->department_name),
			),
			
			array(
					'name'=>'batch_id',
					'type'=> 'html',
					'value'=> nl2br($model->batch->batch_id),
			),
		
			array(
					'name'=>'batch_group',
					'type'=> 'html',
					'value'=> nl2br($model->batchgroup->group_name),
			),
		
		
		//array('name'=>'semester','label'=>'Semester','value'=>'CourseSemesterLebel::model()->find(semester_id=$data->semester and course_id=$data->course_id)->lebel'),
		
	
			
			array(
					'name'=>'semester',
					'type'=> 'html',
					'value'=> nl2br(CourseSemesterLebel::model()->semesterLebel($model->course_id,$model->semester)),
			),
			
			array(
					'name'=>'roll_no',
					'type'=> 'html',
					'value'=> nl2br(Bndate::t($model->roll_no)),
			),
			array(
					'name'=>'bank_id',
					'type'=> 'html',
					'value'=> nl2br($model->bank->name),
			),
			
		
		
		
		
			array(
					'name'=>'total_deposit',
					'type'=> 'html',
					'value'=> nl2br(Bndate::t($model->total_deposit)),
					),
			array(
					'name'=>'deposit_date',
					'type'=> 'html',
					'value'=> nl2br(Bndate::t($model->deposit_date)),
			),
			array(
					'name'=>'input_datetime',
					'type'=> 'html',
					'value'=> nl2br(Bndate::t($model->input_datetime)),
			),
			'full_free',
			'comment',
		
	),
)); ?>
