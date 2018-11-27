<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'auth-user-role-access-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'role_id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php //echo $form->textFieldRow($model,'module',array('class'=>'span5','maxlength'=>250)); ?>
	<?php echo $form->dropDownListRow($model,'module',
  CHtml::listData(AuthModule::model()->findAll(array('order' => 'name' )), 'name', 'name'),
  array('empty'=>'Select here....','class'=>'span5'))?>

	<?php //echo $form->textFieldRow($model,'controller',array('class'=>'span5','maxlength'=>250)); ?>
	<?php echo $form->dropDownListRow($model,'controller',
  CHtml::listData(AuthController::model()->findAll(array('order' => 'name')), 'name', 'name'),
  array('empty'=>'Select here....','class'=>'span5'))?>

	<?php //echo $form->textFieldRow($model,'action',array('class'=>'span5','maxlength'=>250)); ?>
	<?php echo $form->dropDownListRow($model,'action',
  CHtml::listData(AuthAction::model()->findAll(array('order' => 'name' )), 'name', 'name'),
  array('empty'=>'Select here....','class'=>'span5'))?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
