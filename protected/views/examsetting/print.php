<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'batch_ref_course_pk', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course2'),
                                'type' => 'POST',                     
                               'update'=>'#Student_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
			
			<?php echo $form->dropDownListRow($model,'department_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor2'),
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
                                'url' => CController::createUrl('Group2'),
                                'type' => 'POST',                     
                               'update'=>'#Student_batch_group',
                                )),'class'=>'span5','maxlength'=>20)); ?>
								
								
	<?php  echo $form->dropDownListRow($model,'batch_group', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester2'),
                                'type' => 'POST',                     
                               'update'=>'#Student_semester',
                                )),'class'=>'span5','maxlength'=>20)); ?>
								
	 
	<?php echo $form->dropDownListRow($model,'semester', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>
	
	<?php //echo $form->textFieldRow($model,'semester',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->dropDownListRow($model,'session', array('1420'=>'১৪২০','1421'=>'১৪২১','1422'=>'১৪২২','1423'=>'১৪২৩'),array('class'=>'span5', 'maxlength'=>20)); ?>
	<?php echo $form->dropDownListRow($model,'card_type', array('student-1'=>'শিক্ষার্থী-১','student-2'=>'শিক্ষার্থী-২','student-3'=>'শিক্ষার্থী-৩','student-4'=>'শিক্ষার্থী-৪','student-5'=>'শিক্ষার্থী-৫','student-6'=>'শিক্ষার্থী-৬','teacher'=>'শিক্ষক','adteacher'=>'শিক্ষক-1'),array('class'=>'span5', 'maxlength'=>20)); ?>
      <?php echo $form->dropDownListRow($model, 'calendar_name', CHtml::listData(CalendarInfo::model()->findAll(array('order' => 'calendar_name')), 'id', 'calendar_name'), array('empty' => 'Select here....',  'maxlength' => 20, 'class'=>'span3', 'style'=>'height:30px;')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
