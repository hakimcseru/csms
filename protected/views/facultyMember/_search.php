<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'member_id',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'member_name',array('class'=>'span5','maxlength'=>128)); ?>
<?php echo $form->dropDownListRow($model,'faculty_id', CHtml::listData(Faculty::model()->findAll(), 'id', 'faculty_name'),array('empty' => 'Select Faculty','class'=>'span5')); ?>
<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>


	<?php echo $form->textFieldRow($model,'member_father_name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'member_mother_name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'member_present_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'member_permanent_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'member_nationality',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->dropDownListRow($model,'member_gender', $model->enumGender, array('empty'=>'','class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'member_dob',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_profession',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'member_email',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'member_contact',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'member_blood_group',array('class'=>'span5','maxlength'=>10)); ?>



	<?php echo $form->textAreaRow($model,'member_alternate_contact',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>





	<?php //echo $form->textFieldRow($model,'faculty_id',array('class'=>'span5')); ?>

	<div class="actions offset1">
		<?php echo CHtml::submitButton(Yii::t('core','Search'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
