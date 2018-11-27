<?php
$courseSubject = new CourseSubject('search');
$courseSubject->unsetAttributes();  // clear any default values
$courseSubject->course_subject_ref_course_pk = $model->course_pk;
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-subject-grid',
	'summaryText'=>'Total {count} subject(s)',
	'enablePagination'=>false,
	'dataProvider'=>$courseSubject->search(),
	'columns'=>array(
		array(
			'name'=>'course_subject_ref_subject_pk',
			'value'=>'$data->subject->subject_name',
		),
		'course_subject_semester_no',
	),
)); ?>