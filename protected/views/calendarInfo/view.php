<h1 style="text-align:center"><?php echo $model->calendar_name;?></h1>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'class-routine-grid',
	'dataProvider'=>$model3->search($model->id),
	'filter'=>$model3,
	'columns'=>array(
		//'id',
		//'session_id',
	
		//'course_id',
		
		array('name'=>'course_id','value'=>'$data->course_id?$data->course->course_name:null','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),),

		//'department_id',
			array('name'=>'department_id','value'=>'$data->department_id?$data->department->department_name:null','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name'),),
		//'batch_id',
		array('name'=>'batch_id','value'=>'$data->batch_id?$data->batch->batch_id:null','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_pk','batch_id'),),
		
		'batch_group_id'=>array('type'=>'raw','name'=>'batch_group_id','value'=>'$data->batch_group_id?$data->batchgroup->group_name." (". $data->batchgroup->id .")":null','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		//'batch_group_id',
		//'batch_section_id',
		
		array('name'=>'semester_id','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course_id,$data->semester_id,1)','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel')),
		
		array('name'=>'batch_section_id','value'=>'$data->sescion?$data->sescion->section_name:null','filter'=>CHtml::listData(BatchSection::model()->findAll(array('order'=>'section_name')),'section_name','section_name'),),
		//'faculty_member_id',
		
		
		array('name'=>'subject_id','value'=>'$data->subject?$data->subject->subject_name:""','filter'=>CHtml::listData(Subject::model()->findAll(),'subject_name','subject_name')),
		
		array('name'=>'faculty_member_id','value'=>'$data->facultyMember?$data->facultyMember->member_name:null','filter'=>CHtml::listData(FacultyMember::model()->findAll(array('order'=>'member_name')),'member_pk','member_name'),),
		//'room_id',
			array('name'=>'room_id','value'=>'$data->room?$data->room->room_no:null','filter'=>CHtml::listData(Room::model()->findAll(array('order'=>'room_no')),'room_pk','room_no'),),
			array('name'=>'class_period_id','value'=>'$data->classPeriod?$data->classPeriod->name:null','filter'=>CHtml::listData(ClassPeriod::model()->findAll(array('order'=>'name')),'name','name'),),
		//'class_period_id',
		
		//'additional_faculty_member_id',
		array('name'=>'additional_faculty_member_id','value'=>'$data->A_facultyMember?$data->A_facultyMember->member_name:null','filter'=>CHtml::listData(FacultyMember::model()->findAll(array('order'=>'member_name')),'member_pk','member_name'),),
		
		array('name'=>'weekday','value'=>'$data->weekday?$data->weekday:null','filter'=>CHtml::listData(ClassRoutine::model()->findAll(array('order'=>'weekday')),'weekday','weekday'),),
		
		
		
		
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>