<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'contact-manager-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<div class="well">
		<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.') ?>
	</div>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'contact_type', $model->enumContactType, array('class'=>'span6','maxlength'=>3)); ?>

	<?php echo $form->textFieldRow($model,'contact_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'contact_organization',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'contact_email',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'contact_phone',array('class'=>'span6','maxlength'=>32)); ?>

	<?php echo $form->textAreaRow($model,'contact_address',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

	<?php echo $form->textAreaRow($model,'contact_mou',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

	<div class="actions offset7">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Create Contact') : Yii::t('core','Update Contact'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
