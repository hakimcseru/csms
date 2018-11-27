<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'faculty_member_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_section_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'room_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'class_period_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'additional_faculty_member_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>Yii::t('core', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
