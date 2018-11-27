<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'head_title',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'head_code',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'session',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'course',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'student_type',array('class'=>'span5','maxlength'=>3)); ?>

	<?php echo $form->textFieldRow($model,'apply_on_month',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'collection_amount',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'purpose',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>3)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
