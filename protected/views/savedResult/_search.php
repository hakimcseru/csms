<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'course',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'department',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'semester',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'batch_group',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'semester_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'roll_no',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'total_number',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'position',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'published_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'saved_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'saved_by',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>