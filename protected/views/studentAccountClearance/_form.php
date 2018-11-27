<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-form',
	'action'=>Yii::app()->createUrl('//studentAccountClearance/list'),
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

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
	<?php echo $form->dropDownListRow($model,'card_type', array('1'=>'১','2'=>'২','3'=>'৩'),array('class'=>'span5', 'maxlength'=>20)); ?>
       <?php echo $form->textFieldRow($model,'roll_no_start', array('class'=>'span5', 'maxlength'=>20)); ?>
        <?php echo $form->textFieldRow($model,'roll_no_end', array('class'=>'span5', 'maxlength'=>20)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
