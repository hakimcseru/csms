<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'class-model-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'class_ref_room_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_room_no',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'class_start_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_end_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_start_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_end_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_status',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'class_days_on_week',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_batch_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_batch_id',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_subject_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_subject_name',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_semester',array('class'=>'span5')); ?>

	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
