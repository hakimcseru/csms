<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bank-info-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acc_name'); ?>
		<?php echo $form->textField($model,'acc_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'acc_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acc_no'); ?>
		<?php echo $form->textField($model,'acc_no',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'acc_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->