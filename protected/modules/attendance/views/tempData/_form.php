<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'attendance-temp-data-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'id'); ?>
	<?php echo $form->textFieldRow($model,'core_employee_id',array('class'=>'span7','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span7 datepicker')); ?>

	<?php echo $form->textFieldRow($model,'time',array('class'=>'span7 datetimepicker', 'id'=>'kk1')); ?>

	<?php echo $form->dropDownListRow($model,'mode',$model->modeList(),array('class'=>'span7','maxlength'=>4)); ?>

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