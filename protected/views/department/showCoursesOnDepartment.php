
<?php
$courseDepartment = new CourseDepartment('search');
$courseDepartment->unsetAttributes();  // clear any default values
$courseDepartment->department_id = $model->id;
$i=1;
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-subject-grid',
		'summaryText'=>Yii::t('core','Total'). ' '.Bndate::t($courseDepartment->count("department_id = ".$model->id)) .' '. Yii::t('core','Course(s)'),
	'enablePagination'=>false,
	'dataProvider'=>$courseDepartment->search(),

	'columns'=>array(
			array(
					'name'=>Yii::t('core','SN'),
					'value'=>'Bndate::t(++$row)',
			),
		array(
			'name'=>'course_id',
			'value'=>'$data->course->course_name',
		),

		//'course_subject_semester_no',
	),
)); ?>