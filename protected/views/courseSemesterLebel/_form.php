<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'course-semester-lebel-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>
	
	
	<?php /*echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester'),
                                'type' => 'POST',                     
                               'update'=>'#CourseSemesterLebel_semester_id',
                                )),'class'=>'span5','maxlength'=>20)); ?>
	
	<?php echo $form->dropDownListRow($model,'semester_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Lebel'),
                                'type' => 'POST',                     
                               'update'=>'#nn',
                                )),'class'=>'span5','maxlength'=>20)); ?>
	<?php //echo $form->textFieldRow($model,'semester_id',array('class'=>'span5')); */?>
<div id="nn">
	<?php echo $form->textFieldRow($model,'lebel',array('class'=>'span5','maxlength'=>200)); ?>
</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : Yii::t('core','Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
