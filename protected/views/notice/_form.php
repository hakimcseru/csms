





<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'type'=>'horizontal',
	'id'=>'notice-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'notice_title',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textAreaRow($model,'notice_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'start_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'end_date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
