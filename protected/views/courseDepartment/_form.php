<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'course-department-form',
	'enableAjaxValidation'=>false,
		'type'=>'horizontal',
		'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>



	<?php echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('class'=>'span5','maxlength'=>20)); ?>

	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('class'=>'span5','maxlength'=>20)); ?>




	<?php //echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
