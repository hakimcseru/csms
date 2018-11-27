<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'calendar_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'calendar_ref_room_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'calendar_ref_room_no',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'calendar_title',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'calendar_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'calendar_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'calendar_start_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'calendar_end_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'calendar_link',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'calendar_reference',array('class'=>'span5','maxlength'=>32)); ?>

	<div class="actions">
		<?php echo CHtml::submitButton(Yii::t('core','Search'),array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
