<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'core_employee_id',array('class'=>'input-small','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'dateFrom',array('class'=>'input-small datepicker')); ?>

	<?php echo $form->textFieldRow($model,'dateTo',array('class'=>'input-small datepicker')); ?>

	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'icon-search', 'label'=>Yii::t('attendance', 'Search'), )); ?>

<?php $this->endWidget(); ?>
