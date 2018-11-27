<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'room_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'room_no',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textAreaRow($model,'room_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'room_capacity',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'room_condition',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'room_type',array('class'=>'span5','maxlength'=>16)); ?>

	<div class="actions">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
