<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'subject-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'subject_code',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'subject_name',array('class'=>'span5','maxlength'=>128)); ?>
	<?php echo $form->textAreaRow($model,'syllabus',array('rows'=>8,'class'=>'span5')); ?>

	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
