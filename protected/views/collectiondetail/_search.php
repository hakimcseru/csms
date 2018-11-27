<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'student_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'collection_amount',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'collection_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'collection_type',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'bank_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'deposite_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'session_id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'course_id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'year',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'month',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'collection_for',array('class'=>'span5','maxlength'=>16)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>Yii::t('core','Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
