<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->dropDownListRow($model,'session_id',CHtml::listData(StudentEnrollmentInfo::model()->findAll(array('order'=>'session')),'session','session'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'batch_ref_course_pk',CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'department_id',CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'student_ref_batch_pk',CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_pk','batch_id'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'batch_group',CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'id','group_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'semester',CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	
	
	

	<?php echo $form->textFieldRow($model,'roll_no',array('class'=>'span5','maxlength'=>128)); ?>

	







	<div class="actions offset1">
		<?php echo CHtml::submitButton(Yii::t('core','Search'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
