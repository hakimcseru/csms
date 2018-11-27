<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'class_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_room_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_room_no',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'class_start_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_end_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_start_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_end_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_status',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'class_days_on_week',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_batch_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_batch_id',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_subject_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_ref_subject_name',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'class_semester',array('class'=>'span5')); ?>

	<div class="actions">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
