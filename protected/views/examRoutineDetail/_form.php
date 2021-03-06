<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'exam-routine-detail-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); 
		else						
		echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20));
								?>
								
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'department_id', CHtml::listData( Department::model()->findAll(), 'id', 'department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); 
			else					
		echo $form->dropDownListRow($model,'department_id',CHtml::listData(CourseDepartment::model()->findAll("course_id=".$model->course_id),'department.id', 'department.department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20));						
								?>
								
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_batch_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20));
					else			
					echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_batch_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); 			
								
								?>
	
	
	<?php /* if($model->isNewRecord) echo $form->dropDownListRow($model,'subject_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#ClassRoutine_batch_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20));
					else			
					echo $form->dropDownListRow($model,'subject_id', CHtml::listData(Subject::model()->findAll(), 'subject_pk', 'subject_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#ClassRoutine_batch_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); 			
								
								*/ ?>
	
	

	<?php //echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'batch_group_id' ,CHtml::listData(BatchGroup::model()->findAll(), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('BatchSection'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_batch_section_id',
                                )),'empty' => 'Select group','class'=>'span5','maxlength'=>20));
	else
		echo $form->dropDownListRow($model,'batch_group_id' ,CHtml::listData(BatchGroup::model()->findAll("batch_id=".$model->batch_id), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('BatchSection'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_batch_section_id',
                                )),'empty' => 'Select group','class'=>'span5','maxlength'=>20));
								?>
	
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'batch_section_id',CHtml::listData(BexamRoutineGroup::model()->findAll(),'id','group_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('GetSemester'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_semester_id',
                                )),'empty' => 'Select','class'=>'span5')); 
		else 
	 echo $form->dropDownListRow($model,'batch_section_id',CHtml::listData(BexamRoutineGroup::model()->findAll("batch_group_id=".$model->batch_group_id),'id','group_name'),array('empty'=>'Select','onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('GetSemester'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_semester_id',
                                )),'class'=>'span5'));
	?>

	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'semester_id',$model->course_id?CHtml::listData(ClassRoutine::model()->getSemesterAll($model->course_id),'semester_id','lebel'):array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('GetSubject'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_subject_id',
                                )),'empty' => 'Select','class'=>'span5')); 
		else 
	 echo $form->dropDownListRow($model,'semester_id',CHtml::listData(ClassRoutine::model()->getSemesterAll($model->course_id),'semester_id','lebel'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('GetSubject'),
                                'type' => 'POST',                     
                               'update'=>'#ExamRoutineDetail_subject_id',
                                )),'empty' => 'Select','class'=>'span5'));
	?>
	
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'subject_id',CHtml::listData(Subject::model()->findAll(),'subject_pk','subject_name'),array('empty' => 'Select','class'=>'span5')); 
		else 
	 echo $form->dropDownListRow($model,'subject_id',CHtml::listData(Subject::model()->findAll(),'subject_pk','subject_name'),array('empty' => 'Select','class'=>'span5'));
	?>
	
	<?php  echo $form->hiddenField($model,'session_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'faculty_member_id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'faculty_member_id',CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'),array('empty' => 'Select Faculty Member','class'=>'span5')); ?>

	
	<?php echo $form->textFieldRow($model,'exam_time',array('class'=>'span5')); ?>
	
	<?php  echo $form->hiddenField($model,'room_id',array('class'=>'span5')); ?>
	
	<?php //echo $form->textFieldRow($model,'room_id',array('class'=>'span5')); ?>
	<?php //echo $form->dropDownListRow($model,'room_id',CHtml::listData(Room::model()->findAll(), 'room_pk', 'room_no'),array('empty' => 'Select Room','class'=>'span5')); ?>

	
	<?php  echo $form->hiddenField($model,'exam_date_id',array('class'=>'span5')); ?>
	
	<?php //echo $form->dropDownListRow($model,'class_period_id',CHtml::listData(ClassPeriod::model()->findAll(), 'id', 'name'),array('empty' => 'Select Class Period','class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'additional_faculty_member_id',array('class'=>'span5')); ?>
	<?php echo $form->dropDownListRow($model,'additional_faculty_member_id',CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'),array('empty' => 'Select Faculty Member','class'=>'span5')); ?>

	
	<?php echo $form->dropDownListRow($model,'additional_faculty_member_id2',CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'),array('empty' => 'Select Faculty Member','class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'additional_faculty_member_id3',CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'),array('empty' => 'Select Faculty Member','class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'additional_faculty_member_id4',CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'),array('empty' => 'Select Faculty Member','class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'additional_faculty_member_id5',CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'),array('empty' => 'Select Faculty Member','class'=>'span5')); ?>
	
	
	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save') ,
		)); ?>
	</div>

<?php $this->endWidget(); ?>
