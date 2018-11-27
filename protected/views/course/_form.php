<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'course-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');  ?>

	<?php echo $form->errorSummary($model); ?>

	<?php /* echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('class'=>'span5','maxlength'=>20)); */ ?>

	<?php echo $form->textFieldRow($model,'course_name',array('class'=>'span5','maxlength'=>128)); ?>


	<?php // echo $form->textFieldRow($model,'semester',array('class'=>'span5','maxlength'=>128)); ?>


	<div id="semester_lebel_div">
	<div class="control-group ">
		<?php echo $form->label($model,'semester_lebel', array('class'=>'control-label')); ?>
		<div class="controls">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'label'=>Yii::t('core','Add Semister Lebel'),
    'loadingText'=>'loading...',
    'htmlOptions'=>array('id'=>'buttonStateful',),
)); ?>
		</div>

	</div>

	<?php if(isset($semester_lebel))
	{
	 foreach($semester_lebel as $sl):

	 echo '<div class="control-group"><div class="controls">'.$sl->lebel.'</div></div>';

	 endforeach;
	}

	?>
	</div>


	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),array('class'=>'btn primary')); ?>
	</div>
<script>
	$('#buttonStateful').click(function() {
	$('#semester_lebel_div').append('<div class="control-group"><div class="controls"><input type="text" id="Course_course_name" name="semester_lebel[]" value="" maxlength="128" class="span5"></div></div>');

});

</script>
<?php $this->endWidget(); ?>
