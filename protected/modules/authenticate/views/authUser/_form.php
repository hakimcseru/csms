<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'type'=>'horizontal',
	'id'=>'auth-user-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>250)); ?>
<?php if($model->isNewRecord)
	echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>
	<?php echo $form->dropDownListRow($model,'department_id',
  CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),
  array('empty'=>'Select here....','class'=>'span5'))?>

	<?php //echo $form->textFieldRow($model,'role_id',array('class'=>'span5')); ?>
	<?php echo $form->dropDownListRow($model,'role_id',
  CHtml::listData(AuthUserRole::model()->findAll(), 'id', 'name'),
  array('empty'=>'Select here....','class'=>'span5'))?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
