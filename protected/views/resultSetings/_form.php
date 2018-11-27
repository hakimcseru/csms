<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'result-setings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model,'session', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('class'=>'span3')); ?>
	<?php //echo $form->textFieldRow($model,'session',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'start_limit',array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model,'end_limit',array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span3','maxlength'=>250)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
