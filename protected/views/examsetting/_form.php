<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'examsetting-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'session',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'course',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'department',array('class'=>'span5')); ?>
<?php echo $form->dropDownListRow($model,'session', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Session'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_course',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
<?php 
if(isset($model->session))
echo $form->dropDownListRow($model,'course', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_department',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20));
								
else echo $form->dropDownListRow($model,'course', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_department',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
<?php 
if(isset($model->course))
echo $form->dropDownListRow($model,'department', CHtml::listData(CourseDepartment::model()->findAll("course_id=".$model->course), 'department_id', 'department.department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20));
else echo $form->dropDownListRow($model,'department', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
								
<?php 
if(isset($model->course))
echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll("batch_ref_course_pk=".$model->course), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_batch_group',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20));	

else echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_batch_group',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>

<?php 
if(isset($model->batch_id))
echo $form->dropDownListRow($model,'batch_group', CHtml::listData(BatchGroup::model()->findAll("batch_id=".$model->batch_id), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Semester'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_semester',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20));


else echo $form->dropDownListRow($model,'batch_group', CHtml::listData(BatchGroup::model()->findAll(), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Semester'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_semester',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); ?>

								
								
<?php 
if($model->course)
echo $form->dropDownListRow($model,'semester',  CHtml::listData(CourseSemesterLebel::model()->findAll("course_id=".$model->course),'semester_id','lebel'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Subject'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_subject',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); 

else echo $form->dropDownListRow($model,'semester', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Subject'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_subject',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>							
	<?php // echo $form->textFieldRow($model,'subject',array('class'=>'span5')); ?>
	<?php 
	if($model->course && $model->department && $model->semester)
	echo $form->dropDownListRow($model,'subject', CHtml::listData(CourseSubject::model()->findAll("course_subject_ref_course_pk =".$model->course." and course_subject_department_id = ".$model->department." and course_subject_semester_no =".$model->semester),'course_subject_ref_subject_pk','subject.subject_name'), array('class'=>'span5','maxlength'=>20));
	
	else echo $form->dropDownListRow($model,'subject', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>
    <?php echo $form->textFieldRow($model,'pass_mark',array('class'=>'span5')); ?>
	 <?php echo $form->textFieldRow($model,'full_mark',array('class'=>'span5')); ?>
	<?php // echo $form->textFieldRow($model,'mark_type',array('class'=>'span5','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($model,'mark_type', array('Average'=>'Average','Sum'=>'Sum','Grading'=>'Grading'), array('empty' => 'Select here..','class'=>'span5','maxlength'=>20)); ?>
	<?php //echo $form->textFieldRow($model,'teacher',array('class'=>'span5')); ?>
	<?php echo $form->dropDownListRow($model,'lock', array('Yes'=>'Yes','No'=>'No'), array('class'=>'span5','maxlength'=>20)); ?>
	<?php
	$sel=array();
	if(isset($model->teacher2))
	{
		
		foreach($model->teacher2 as $tech):
			$sel[$tech->faculty_member_id]= array('selected' => 'selected');
		endforeach;
		echo $form->dropDownListRow($model,'teacher', CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'), array('multiple'=>'multiple','size'=>15, 'class'=>'span6','options' =>$sel));
	}
	else {
        echo $form->dropDownListRow($model,'teacher', CHtml::listData(FacultyMember::model()->findAll("1 order by member_name ASC"), 'member_pk', 'member_name'), array('multiple'=>'multiple','size'=>15, 'class'=>'span6'));
		}
     ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
