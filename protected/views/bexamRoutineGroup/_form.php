<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'bexam-routine-group-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model,'session_id', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Session'),
                                'type' => 'POST',                     
                               'update'=>'#BexamRoutineGroup_course_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
<?php echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#BexamRoutineGroup_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#BexamRoutineGroup_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#BexamRoutineGroup_batch_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>
	
	
	
	
	

	<?php //echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>
	<?php 
	if($model->batch_group_id)
	echo $form->dropDownListRow($model,'batch_group_id', CHtml::listData(BatchGroup::model()->findAll("batch_id=".$model->batch_id), 'id', 'group_name'), array('class'=>'span5','maxlength'=>20)); 
	else
	echo $form->dropDownListRow($model,'batch_group_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('GetSemester'),
                                'type' => 'POST',                     
                               'update'=>'#BexamRoutineGroup_semester',
                                )),'class'=>'span5','maxlength'=>20)); 
	?>
	
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'semester',$model->course_id?CHtml::listData(ClassRoutine::model()->getSemesterAll($model->course_id),'semester_id','lebel'):array(''=>''),array('empty' => 'Select','class'=>'span5')); 
		else 
	 echo $form->dropDownListRow($model,'semester',CHtml::listData(ClassRoutine::model()->getSemesterAll($model->course_id),'semester_id','lebel'),array('empty' => 'Select','class'=>'span5'));
	?>
	

	<?php echo $form->textFieldRow($model,'group_name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'start_role',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'end_role',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>




