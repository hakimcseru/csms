<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<div class="well">
		<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?>
	</div>

	<?php echo $form->errorSummary($model); ?>

			
			<?php 
			
			
			echo $form->dropDownListRow($model,'enrollment_status', array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি'),array('class'=>'span5','maxlength'=>20)); 
				
			echo $form->textFieldRow($model,'admission_reference',array('class'=>'span6' )); ?>
			
			<?php 
			
			$model2 = new StudentEnrollmentInfo;
			$criteria=new CDbCriteria;
			$criteria->select='max(student_id) AS maxId';
			$row = $model2->model()->find($criteria);
			if(isset($row))
			$mxId = $row['maxId']+1;
			
			else $mxId='';
			
			echo $form->textFieldRow($model,'student_id',array('class'=>'span6', 'value'=>$mxId)); ?>

			<?php echo $form->textFieldRow($model,'student_name',array('class'=>'span6', 'maxlength'=>128)); ?>

			<?php echo $form->dropDownListRow($model,'batch_ref_course_pk', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#Student_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
			
			<?php echo $form->dropDownListRow($model,'department_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#Student_batch_ref',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
								
			
			
			<?php /* echo $form->dropdownList($model,'student_name',$List,
                                array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#school_id',
                                )),'style'=>'width:180px;'
                                    )
                                ) */?>
			
	<?php echo $form->dropDownListRow($model,'batch_ref', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#Student_batch_group',
                                )),'class'=>'span5','maxlength'=>20)); ?>
								
								
	<?php  echo $form->dropDownListRow($model,'batch_group', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester'),
                                'type' => 'POST',                     
                               'update'=>'#Student_semester',
                                )),'class'=>'span5','maxlength'=>20)); ?>
								
	
	<?php echo $form->dropDownListRow($model,'semester', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>
	
	<?php //echo $form->textFieldRow($model,'semester',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->dropDownListRow($model,'session', array('1420'=>'১৪২০','1421'=>'১৪২১','1422'=>'১৪২২','1423'=>'১৪২৩'),array('class'=>'span5', 'maxlength'=>20)); ?>
	
	<hr />
	
	<?php echo $form->dropDownListRow($model,'bank_info', CHtml::listData(BankInfo::model()->findAll(), 'id', 'name'), array('class'=>'span5','maxlength'=>20)); ?>
	<?php echo $form->textFieldRow($model,'total_deposit',array('class'=>'span6')); ?>
	
	
	<div class="control-group <?php echo ($model->hasErrors('date_of_deposit'))? 'error' : '' ?>">
		<?php echo $form->label($model,'date_of_deposit', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'Student[date_of_deposit]',
				'value'=> $model->date_of_deposit,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span6',
				),
			));
			?>
			<?php echo $form->error($model,'date_of_deposit'); ?>
		</div>
	<?php // echo $form->textFieldRow($model,'date_of_deposit',array('class'=>'span6')); ?>
	
	</div>
	
	

	
	<div class="actions offset7">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Add Student')  : 'Update Records',array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
