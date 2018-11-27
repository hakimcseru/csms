<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-enrollment-info-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

<?php /* $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-enrollment-info-form',
	'enableAjaxValidation'=>false,
)); */?>

	<div class="well">
		<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?>
	</div>



	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'enrollment_status', array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি'),array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'admission_reference',array('class'=>'span5','maxlength'=>50)); ?>

            
	<?php 
        if(!$model->student_id)
        echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->dropDownListRow($model,'course_id',CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>


<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_batch_group',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>

	<?php // echo $form->textFieldRow($model,'batch_id',array('class'=>'span5')); ?>


	<?php // echo $form->textFieldRow($model,'batch_group',array('class'=>'span5')); ?>


    <?php echo $form->dropDownListRow($model,'batch_group', CHtml::listData(BatchGroup::model()->findAll("batch_id=".$model->batch_id), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester'),
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_semester',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->dropDownListRow($model,'semester', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->dropDownListRow($model,'bank_id', CHtml::listData(BankInfo::model()->findAll(), 'id', 'name'), array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'total_deposit',array('class'=>'span5')); ?>

	<?php // echo $form->textFieldRow($model,'deposit_date',array('class'=>'span5')); ?>


<div class="control-group <?php echo ($model->hasErrors('deposit_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'deposit_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'studentEnrollmentInfo[deposit_date]',
				'value'=> $model->deposit_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span5',
				),
			));
			?>
			<?php echo $form->error($model,'deposit_date'); ?>
		</div>
	<?php // echo $form->textFieldRow($model,'date_of_deposit',array('class'=>'span6')); ?>

	</div>

	<?php // echo $form->textFieldRow($model,'input_datetime',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'semester',array('class'=>'span5')); ?>



	<?php echo $form->textFieldRow($model,'session',array('class'=>'span5','maxlength'=>10)); ?>

	<?php // echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>




	

	<?php echo $form->textFieldRow($model,'roll_no',array('class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'full_free', array('Yes'=>'Yes','No'=>'No') , array('class'=>'span5','maxlength'=>20)); ?>
	<?php echo $form->textAreaRow($model,'comment',array('class'=>'span6')); ?>
	
	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : Yii::t('core','Save'),
		)); ?>
	</div>

<script type="text/javascript">
<?php
echo CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester2'),
                                'data'=> 'js:{batch_group:$("#StudentEnrollmentInfo_batch_group").val(),course:$("#StudentEnrollmentInfo_course_id").val(),semester:'.$model->semester.'}',
                                'type' => 'POST',                     
                               'update'=>'#StudentEnrollmentInfo_semester',
                                ));
?>
</script>                                
<?php $this->endWidget(); ?>