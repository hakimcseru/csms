<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'class-period-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->dropDownListRow($model,'week_day',array('Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday'),array('class'=>'span5','maxlength'=>9)); ?>

	<?php echo $form->textFieldRow($model,'start_time',array('class'=>'span5 timepicker')); ?>
	
		
	<?php echo $form->textFieldRow($model,'end_time',array('class'=>'span5 timepicker' )); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $this->widget('application.widgets.timepicker.registerScript', array()); ?>