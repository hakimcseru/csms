<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'account-process-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'month',array('1'=>'Boishak','2'=>'Jostho','3'=>'Ashar','4'=>'Srabon','5'=>'Vadro','6'=>'Ashin','7'=>'Kartik','8'=>'Agrohayon','9'=>'Poush','10'=>'Magh','11'=>'Falgun','12'=>'Choitro'),array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'year',array('1420'=>'১৪২০','1421'=>'১৪২১','1422'=>'১৪২২','1423'=>'১৪২৩'),array('class'=>'span2','maxlength'=>4)); ?>

	<?php //echo $form->textFieldRow($model,'process_date',array('class'=>'span5')); ?>

	<?php // echo $form->textFieldRow($model,'process_status',array('class'=>'span5','maxlength'=>7)); ?>

	<?php //echo $form->textFieldRow($model,'lock',array('class'=>'span5','maxlength'=>3)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
