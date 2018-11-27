<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'dateFrom',array('class'=>'input-small hasDatepicker')); ?>
	<?php echo $form->textFieldRow($model,'dateTo',array('class'=>'input-small hasDatepicker')); ?>

	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'icon-search', 'label'=>Yii::t('attendance', 'Search'), )); ?>

<?php $this->endWidget(); ?>
