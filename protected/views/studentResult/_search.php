<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'session',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'course',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'department',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'student_pk',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'full_marks',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'semester',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_group',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
