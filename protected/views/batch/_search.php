<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'batch_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'batch_id',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'batch_start_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_end_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_status',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'batch_ref_course_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'batch_ref_course_name',array('class'=>'span5','maxlength'=>128)); ?>

	<div class="actions">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
