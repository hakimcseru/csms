<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'faculty-member-form',
	'type'=>'horizontal',
	//'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>


		<?php //echo Yii::t('core','Fields with <span class="required">*</span> are required.');?>
	

<?php echo $form->errorSummary($model); ?>

	

			<?php echo $form->dropDownListRow($model,'faculty_id', CHtml::listData(Faculty::model()->findAll(), 'id', 'faculty_name'),array('class'=>'span6')); ?>

			<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>

		<a href="#" onclick="jQuery.ajax({'url':'/temp_project/csms/en/notice/getfIds','type':'GET','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#FacultyMember_member_id').html(html)}});" >load</a>
	<?php echo $form->listBox($model,'member_id', array(''=>'')); ?>
	<!--<div class="actions offset7">
		<?php //echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Add Faculty Member') :  Yii::t('core','Update Records'),array('class'=>'btn-primary')); ?>
	</div>-->

<?php $this->endWidget(); ?>
