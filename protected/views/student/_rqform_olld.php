<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well','onsubmit'=>'return validate(this);'),
	'enableAjaxValidation'=>false,
)); ?>
<script>
function validate(form) {


    // validation code here ...
	var valid=1;
	var messsage="";
	var nval=$("#Student_session").val();
	var tdues=$("#tdues").val();
	var trem=$("#trem").val();
	var tdep=$("#Student_total_deposit").val();
	var mindep=$("#Student_minpay").val();
	mindep=mindep+tdues-trem;
	
	
	$("[name=vvv\\[\\]]").each(function() {
	if(nval==$(this).val()) {valid=0; message="Invalid Session";}
	});
	
	if(tdep < mindep) {valid=0; message="Minimum payment amount is:"+mindep;}

//alert($("#Student_minpay").val());
	
    if(!valid) {
        alert(message);
        return false;
    }
    else {
        return confirm('Do you really want to submit the form?');
    }
}
</script>

    <?php foreach($model->EnrollmentInfoAll as $enn):
	echo '<input type="hidden" name="vvv[]" value="'.$enn->session.'" />';
	endforeach;?>
	<input type="hidden" id="tdues"  name="tdues" value="<?=$tdues;?>" />
	<?php 
	$trem=0;
	$trem1=StudentRemaining::model()->find("student_id='".$model->student_id."' and session_id='".$eninfo->session."'");
	if(isset($trem1)) $trem=$trem1->remaining_amount;
	?>
	<input type="hidden" id="trem" name="trem" value="<?=$trem;?>" />
	<!--style="display:none"--> 
	<?php 
	$mmiiinn=0;
	$mmiiinn=$eninfo->getMinPay($_POST['IDSearchForm']['session'],$model->EnrollmentInfoLast->course_id, 'Renew');
	?>
	
	<select  name="Student_minpay"  style="display:none" id="Student_minpay" >
	<option value="<?=$mmiiinn;?>"><?=$mmiiinn;?></option>
	
	</select>
	<div class="well">
		<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?>
	</div>

	<?php echo $form->errorSummary($model); ?>

			
			<?php 
			echo $form->dropDownListRow($model,'enrollment_status', array('Renew'=>'পুনর্ভর্তি'),array('class'=>'span5','maxlength'=>20)); 
				
			echo $form->textFieldRow($model,'admission_reference',array('class'=>'span6' )); ?>
			
			<?php 
			
			$model2 = new StudentEnrollmentInfo;
			$criteria=new CDbCriteria;
			$criteria->select='max(student_id) AS maxId';
			$row = $model2->model()->find($criteria);
			if(isset($row))
			$mxId = $row['maxId']+1;
			
			else $mxId='';
			
			echo $form->textFieldRow($model,'student_id',array('class'=>'span6',)); ?>

			<?php echo $form->textFieldRow($model,'student_name',array('class'=>'span6', 'maxlength'=>128)); ?>

			<?php echo $form->dropDownListRow($model,'batch_ref_course_pk', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#Student_department_id',
                                )),'options' => array($model->EnrollmentInfoLast->course_id=>array('selected'=>true)),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
			
			<?php echo $form->dropDownListRow($model,'department_id',CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#Student_batch_ref',
                                )),'options' => array($model->EnrollmentInfoLast->department_id=>array('selected'=>true)),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
								
			
			
			<?php /* echo $form->dropdownList($model,'student_name',$List,
                                array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#school_id',
                                )),'style'=>'width:180px;'
                                    )
                                ) */?>
			
	<?php echo $form->dropDownListRow($model,'batch_ref', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#Student_batch_group',
                                )),'options' => array($model->EnrollmentInfoLast->batch_id=>array('selected'=>true)),'class'=>'span5','maxlength'=>20)); ?>
								
								
	<?php  echo $form->dropDownListRow($model,'batch_group', CHtml::listData(BatchGroup::model()->findAll("batch_id=".$model->EnrollmentInfoLast->batch_id), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester'),
                                'type' => 'POST',                     
                               'update'=>'#Student_semester',
                                )),'options' => array($model->EnrollmentInfoLast->batch_group=>array('selected'=>true)),'class'=>'span5','maxlength'=>20)); ?>
								
	<?php
			$model3 = Course::model()->findByPk($model->EnrollmentInfoLast->course_id);
				
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				$sem=array();
				if($model3->semester)
				{
				
				for($i=1;$i<=$model3->semester;$i++)
				{
				
				
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$model->EnrollmentInfoLast->course_id." and semester_id=".$i);
					$sem[$i]=$clebel->lebel;
					
				
				}
				}
	?>
	
	<?php echo $form->dropDownListRow($model,'semester', $sem, array('options' => array($model->EnrollmentInfoLast->semester=>array('selected'=>true)),'class'=>'span5','maxlength'=>20)); ?>
	
	<?php //echo $form->textFieldRow($model,'semester',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->dropDownListRow($model,'session', array('1420'=>'১৪২০','1421'=>'১৪২১','1422'=>'১৪২২','1423'=>'১৪২৩'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Minpay'),
                                'type' => 'POST',                     
                               'update'=>'#Student_minpay',
                                )),'options' => array($_POST['IDSearchForm']['session']=>array('selected'=>true)),'class'=>'span5', 'maxlength'=>20)); ?>
	
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
	
	
	<?php echo $form->dropDownListRow($model,'full_free', array('Yes'=>'Yes','No'=>'No') , array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Minpay'),
                                'type' => 'POST',                     
                               'update'=>'#Student_minpay',
                                )),'options' => array('No'=>array('selected'=>true)),'class'=>'span5','maxlength'=>20)); ?>
	
	<?php echo $form->textAreaRow($model,'comment',array('class'=>'span6')); ?>
	<div class="actions offset7">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Add Student')  : 'Update Records',array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
