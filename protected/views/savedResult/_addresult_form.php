<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'saved-result-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'session_id', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Session'),
                                'type' => 'POST',                     
                               'update'=>'#SavedResult_course_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
								
	<?php echo $form->dropDownListRow($model,'course_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#SavedResult_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'department_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#SavedResult_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#SavedResult_batch_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>

	 <?php echo $form->dropDownListRow($model,'batch_group_id', CHtml::listData(BatchGroup::model()->findAll(), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Semester'),
                                'type' => 'POST',                     
                               'update'=>'#SavedResult_semester_id',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); ?>

								
								
	<?php echo $form->dropDownListRow($model,'semester_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Subject'),
                                'type' => 'POST',                     
                               'update'=>'#SavedResult_subject',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>							
								
	<?php //echo $form->textFieldRow($model,'course',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'department',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'semester',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'batch_group',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'semester_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'roll_no',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'total_number',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'position',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'published_date',array('class'=>'span5 datetimepicker')); ?>

	<?php //echo $form->textFieldRow($model,'saved_date',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'saved_by',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
