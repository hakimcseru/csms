<?php
$courseSubject = new CourseSubject('search');
$courseSubject->unsetAttributes();  // clear any default values
$courseSubject->course_subject_ref_course_pk = $model->course_id;
$courseSubject->course_subject_department_id = $model->department_id;
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-subject-grid',
	'dataProvider'=>$courseSubject->search(),
	'columns'=>array(
		array(
			'name'=>'course_subject_ref_subject_pk',
			'value'=>'$data->subject->subject_name',
		),
			array(
					'name'=>'course_subject_semester_no',
					'value'=>'CourseSemesterLebel::model()->semesterLebel($data->course_subject_ref_course_pk,$data->course_subject_semester_no)',
			),


	),
)); ?>


