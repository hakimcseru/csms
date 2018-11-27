<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'saved-result-subject-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'saved_result_id',array('class'=>'span5')); ?>

	<?php 
	$sr=SavedResult::model()->findByPk($model->saved_result_id);
	
	echo $form->dropDownListRow($model,'subject_id',CHtml::listData(CourseSubject::model()->findAll('course_subject_ref_course_pk='.$sr->course_id." and course_subject_department_id=".$sr->department_id." and course_subject_semester_no=".$sr->semester_id),'subject.subject_pk','subject.subject_name'),array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'subject_code',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'subject_name',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'subject_full_mark',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'student_subject_marks',array('class'=>'span5','maxlength'=>100)); ?>
	
	<?php echo $form->textFieldRow($model,'subject_min_mark',array('class'=>'span5','maxlength'=>100)); ?>
	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
