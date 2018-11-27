<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'attendance-final-data-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'core_employee_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'core_employee_name',array('class'=>'span7','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'core_shift_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'core_shift_name',array('class'=>'span7','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'core_department_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'core_department_name',array('class'=>'span7','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span7 datepicker')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span7','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'in_time',array('class'=>'span7 datetimepicker')); ?>

	<?php echo $form->textFieldRow($model,'break_start',array('class'=>'span7 datetimepicker')); ?>

	<?php echo $form->textFieldRow($model,'break_end',array('class'=>'span7 datetimepicker')); ?>

	<?php echo $form->textFieldRow($model,'out_time',array('class'=>'span7 datetimepicker')); ?>

	<?php echo $form->textFieldRow($model,'work_hour',array('class'=>'span7')); ?>

	<?php echo $form->textFieldRow($model,'over_time',array('class'=>'span7')); ?>

	<?php echo $form->textFieldRow($model,'note',array('class'=>'span7','maxlength'=>256)); ?>

	<?php echo $form->textAreaRow($model,'json_log',array('rows'=>6, 'cols'=>50, 'class'=>'span7')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('attendance', 'Create') : Yii::t('attendance', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $this->widget('application.widgets.timepicker.registerScript', array()); ?>