<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'examsetting-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'session',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'course',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'department',array('class'=>'span5')); ?>
<?php echo $form->dropDownListRow($model,'session', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Session'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_course',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
<?php echo $form->dropDownListRow($model,'course', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_department',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'department', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_batch_group',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>

	 <?php echo $form->dropDownListRow($model,'batch_group', CHtml::listData(BatchGroup::model()->findAll(), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Semester'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_semester',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); ?>

								
								
	<?php echo $form->dropDownListRow($model,'semester', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Subject'),
                                'type' => 'POST',                     
                               'update'=>'#Examsetting_subject',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>							
	<?php // echo $form->textFieldRow($model,'subject',array('class'=>'span5')); ?>
	<?php //echo $form->dropDownListRow($model,'subject', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>

	<?php // echo $form->textFieldRow($model,'mark_type',array('class'=>'span5','maxlength'=>100)); ?>
	<?php //echo $form->dropDownListRow($model,'mark_type', array('Average'=>'Average','Sum'=>'Sum','Grading'=>'Grading'), array('empty' => 'Select here..','class'=>'span5','maxlength'=>20)); ?>
	<?php //echo $form->textFieldRow($model,'teacher',array('class'=>'span5')); ?>
	<?php
       // echo $form->dropDownListRow($model,'teacher', CHtml::listData(FacultyMember::model()->findAll(), 'member_pk', 'member_name'), array('multiple'=>'multiple','size'=>5, 'class'=>'span4'));
     ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'View' : 'Save',
		)); ?>
	
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Print' : 'Save',
		)); ?>
	
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Marksheet' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
