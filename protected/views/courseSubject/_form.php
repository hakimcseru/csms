<?php echo $model->subject->subject_name.'<br />'; ?>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'course-subject-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'course_subject_pk'); ?>

	<?php echo $form->hiddenField($model,'course_subject_ref_course_pk'); ?>

	<?php echo $form->hiddenField($model,'course_subject_ref_subject_pk'); ?>

	<?php echo $form->hiddenField($model,'course_subject_department_id'); ?>

	<?php


	$sem_tot=Course::model()->findByPk($model->course_subject_ref_course_pk)->semester;

	for($i=1;$i<=$sem_tot;$i++)
	{
		$sem_leb=CourseSemesterLebel::model()->find("course_id=".$model->course_subject_ref_course_pk." and semester_id=".$i );
		if($sem_leb->lebel)

		 $val[$i]=$sem_leb->lebel;
		 else $val[$i]=$i;
	}
	?>

	<?php //echo $form->textFieldRow($model,'course_subject_semester_no',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'course_subject_semester_no', $val, array('class'=>'span5','maxlength'=>20)); ?>
	
	<?php echo $form->textFieldRow($model,'pass_mark',array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'full_mark',array('class'=>'span5')); ?>



	<div class="actions">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
