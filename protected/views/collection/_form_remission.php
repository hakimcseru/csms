<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-collection-detail-form',
        
	'enableAjaxValidation'=>false,
    'type'=>'horizontal',
)); ?>

<?php echo $form->hiddenField($model,'student_pk',array('value'=>$model2->student_pk)); ?>

	<?php echo $form->hiddenField($model,'student_id',array('value'=>$model2->student_id)); ?>
<?php echo $form->hiddenField($model,'collection_date',array('value'=>date("Y-m-d H:i:s"))); ?>

 <?php $bndate = new Bndate(strtotime($_POST['IDSearchForm']['deposit_date']));
                $month=$bndate->BanglaNumMonth2();
                $date=$bndate->get_date();
                $year=$bndate->getBnToEnYear($date[2]);
                ?>
	<?php echo $form->hiddenField($model,'session_id',array('value'=>$_POST['IDSearchForm']['session'])); ?>

	<?php $model333=StudentEnrollmentInfo::model()->find("student_pk='".$model2->student_pk."' and  session='".$_POST['IDSearchForm']['session']."'");?>
	
	<?php echo $form->hiddenField($model,'course_id',array('value'=>$model333->course_id)); ?>

	<?php echo $form->hiddenField($model,'year',array('value'=>$_POST['IDSearchForm']['session'])); ?>

	<?php echo $form->hiddenField($model,'month',array('value'=>$month)); ?>

	<?php echo $form->hiddenField($model,'collection_for',array('value'=>'মওকুফ')); ?>	
	<?php echo $form->hiddenField($model,'collection_type',array('value'=>'মওকুফ')); ?>	

	

	
	<?php echo $form->textFieldRow($model,'collection_amount',array('class'=>'span6')); ?>
	<?php //echo $form->textFieldRow($model,'discount',array('class'=>'span6')); ?>
	

	

	

	<?php //echo $form->dropDownListRow($model,'collection_type',array('Cheque'=>'Cheque','Cash'=>'Cash'),array('class'=>'span6')); ?>

	<?php //echo $form->dropDownListRow($model,'bank_id',CHtml::listData(BankInfo::model()->findAll(), 'id', 'name'), array('empty'=>'','class'=>'span6','maxlength'=>20));?>

	
	<?php // echo $form->textFieldRow($model,'deposite_date',array('class'=>'span5')); ?>
        
        <div class="control-group <?php echo ($model->hasErrors('deposite_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'deposite_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'StudentCollectionDetail[deposite_date]',
				'value'=> $model->deposite_date,
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
			<?php echo $form->error($model,'deposite_date'); ?>
		</div>
	<?php // echo $form->textFieldRow($model,'date_of_deposit',array('class'=>'span6')); ?>
	
	</div>
	<?php echo $form->hiddenField($model,'collection_date',array('class'=>'span6','value'=>date("Y-m-d H:i:s"))); ?>
        
       <?php echo $form->textAreaRow($model,'comment',array('rows'=>3, 'cols'=>50, 'class'=>'span6')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
