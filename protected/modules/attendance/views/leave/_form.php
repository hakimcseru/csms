<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'attendance-leave-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'core_employee_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'start_date',array('class'=>'span7 datepicker')); ?>

	<?php echo $form->textFieldRow($model,'end_date',array('class'=>'span7 datepicker')); ?>

	<?php echo $form->textFieldRow($model,'duration',array('class'=>'span7')); ?>

	<?php echo $form->dropDownListRow($model,'type', $model->types, array('class'=>'span7','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span7','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'responsible_person_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'approved_by_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'note',array('class'=>'span7','maxlength'=>256)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('attendance', 'Create') : Yii::t('attendance', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $this->widget('application.widgets.timepicker.registerScript', array()); ?>