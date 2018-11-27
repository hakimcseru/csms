<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->dropDownListRow($model,'enrollment_status', array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি','Reexam'=>'মানোন্নয়ন'),array('empty'=>'Select','class'=>'span5','maxlength'=>20)); ?>

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

	<?php echo $form->textFieldRow($model,'input_datetime',array('class'=>'span5')); ?>


<div class="actions offset2">
		<?php echo CHtml::submitButton(Yii::t('core','Search'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
