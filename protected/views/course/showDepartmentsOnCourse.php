<?php
$courseDepartment = new CourseDepartment('search');
$courseDepartment->unsetAttributes();  // clear any default values
$courseDepartment->course_id = $model->course_pk;
$i=1;
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-subject-grid',
		'summaryText'=>Yii::t('core','Total'). ' '.Bndate::t($courseDepartment->count("course_id = ".$model->course_pk)) .' '. Yii::t('core','Department(s)'),
	'enablePagination'=>false,
	'dataProvider'=>$courseDepartment->search(),
		
	'columns'=>array(
			array(
					'name'=>Yii::t('core','SN'),
					'value'=>'Bndate::t(++$row)',
			),
		array(
			'name'=>'department_id',
			'value'=>'$data->department->department_name',
		),
		
		//'course_subject_semester_no',
	),
)); ?>