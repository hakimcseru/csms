<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>250)); ?>

			<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>250)); ?>

		<?php echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'role_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
