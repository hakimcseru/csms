<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'account-process-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'month',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'year',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'process_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'process_status',array('class'=>'span5','maxlength'=>7)); ?>

	<?php echo $form->textFieldRow($model,'lock',array('class'=>'span5','maxlength'=>3)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
