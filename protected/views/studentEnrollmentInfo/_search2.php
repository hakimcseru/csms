<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
)); ?>


<?php echo $form->dropDownListRow($model,'session',CHtml::listData(StudentEnrollmentInfo::model()->findAll(array('order'=>'session')),'session','session'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>

<?php echo $form->dropDownListRow($model,'course_id',CHtml::listData(Course::model()->findAll(), 'course_name', 'course_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>


<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'department_name', 'department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_id', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_batch_group',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->dropDownListRow($model,'batch_group',CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'semester',CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php // echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>


	<?php // echo $form->textFieldRow($model,'batch_group',array('class'=>'span5')); ?>


    


<?php /* echo $form->dropDownListRow($model,'enrollment_status', array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি','Reexam'=>'মানোন্নয়ন'),array('empty'=>'Select','class'=>'span5','maxlength'=>20)); ?>

     <?php echo $form->dropDownListRow($model,'admission_reference',
     CHtml::listData(StudentEnrollmentInfo::model()->findAll(), 'admission_reference', 'admission_reference'),
     array('empty'=>'Select here....','class'=>'span5'))?>
	 
	<?php echo $form->dropDownListRow($model,'session', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423','1424'=>'1424','1425'=>'1425','1426'=>'1426','1427'=>'1427'),array('empty'=>'Select','class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'bank_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'total_deposit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'deposit_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'input_datetime',array('class'=>'span5')); */ ?>


<?php /* echo $form->dropDownListRow($model,'session',CHtml::listData(StudentEnrollmentInfo::model()->findAll(array('order'=>'session')),'session','session'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'batch_id',CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'department_id',CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'batch_id',CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_pk','batch_id'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'batch_group',CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'id','group_name'),array('empty'=>'','class'=>'span5','maxlength'=>16)); ?>
	
	<?php echo $form->dropDownListRow($model,'semester',CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel'),array('empty'=>'','class'=>'span5','maxlength'=>16)); */?>

<div class="actions offset2">
		<?php echo CHtml::submitButton(Yii::t('core','Search'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
