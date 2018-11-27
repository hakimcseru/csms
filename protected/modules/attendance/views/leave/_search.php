<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'core_employee_id',array('class'=>'input-small','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'start_date',array('class'=>'input-small datepicker', 'id'=>'start_date_search')); ?>

	<?php echo $form->textFieldRow($model,'end_date',array('class'=>'input-small datepicker', 'id'=>'end_date_search')); ?>

	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'icon-search', 'label'=>Yii::t('attendance', 'Search'), )); ?>

<?php $this->endWidget(); ?>
