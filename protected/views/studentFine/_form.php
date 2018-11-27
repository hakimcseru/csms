<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-fine-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'student_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'amount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fine_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'year',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'month',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'comment',array('class'=>'span5','maxlength'=>250)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
