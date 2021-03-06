<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'auth-user-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


<?php 
	echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>250)); ?>



<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
