<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'faculty-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'faculty_name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'faculty_code',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
