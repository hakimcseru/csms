<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'attendance-release-setting-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->dropDownListRow($model,'session', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('empty' => 'Select Session','class'=>'span5','maxlength'=>20)); ?>
<?php echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>

	<?php // echo $form->textFieldRow($model,'session',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'min_allendance',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
