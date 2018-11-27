<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'auth-module-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>3)); ?>
	<?php echo $form->dropDownListRow($model, 'active',
	    array('Yes' => 'Active', 'No' => 'Inactive'),
	 
		array('class'=>'span2')
	); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
