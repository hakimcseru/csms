<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'student_name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'student_father_name',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'student_mother_name',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'student_present_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'student_permanent_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'student_nationality',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'student_gender',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'student_dob',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'occupation',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'student_email',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'student_contact',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'student_blood_group',array('class'=>'span5','maxlength'=>3)); ?>



	<?php echo $form->textAreaRow($model,'student_alternate_contact',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>







	<div class="actions offset1">
		<?php echo CHtml::submitButton(Yii::t('core','Search'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
