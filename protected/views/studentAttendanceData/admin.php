<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Attendance Data'),
);


?>

<h1><?php echo Yii::t('core','Student Attendance Data');?></h1>


<a href="create" type="submit" class="btn btn-primary">তৈরি করুন</a>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-attendance-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		
		
                'student_reg_no'=>array('name'=>'student_reg_no','value'=>'Bndate::t($data->student_reg_no)'),
                array('type'=>'raw','name'=>'student.student_name','value'=>'$data->student->student_name'),

		'date'=>array('name'=>'date','value'=>'Bndate::t($data->date, true)'),
		'time'=>array('name'=>'time','value'=>'Bndate::t(date("H:i:s", strtotime($data->time))) ',
                    ),
		array('name'=>'weekday','value'=>'Bndate::t(date("l", strtotime($data->date))) ',
                    ),
		/*
		'note',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
