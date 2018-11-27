<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'collection-head-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'head_group_id',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->dropDownListRow($model,'head_group_id', CHtml::listData(StudentCollectionGroup::model()->findAll(), 'id', 'group_name'),array('empty' => 'Select Head','class'=>'span2','maxlength'=>20)); ?>

	<?php echo $form->dropDownListRow($model,'session',array('1420'=>'১৪২০','1421'=>'১৪২১','1422'=>'১৪২২','1423'=>'১৪২৩'),array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'course',CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'),array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'student_type',array('New'=>'নতুন ভর্তি','Renew'=>'পুনর্ভর্তি','Reexam'=>'মানোন্নয়ন'),array('class'=>'span2','maxlength'=>13)); ?>

	<?php echo $form->dropDownListRow($model,'apply_on_month',array('0'=>'All Month','1'=>'Boishak','2'=>'Jostho','3'=>'Ashar','4'=>'Srabon','5'=>'Vadro','6'=>'Ashin','7'=>'Kartik','8'=>'Agrohayon','9'=>'Poush','10'=>'Magh','11'=>'Falgun','12'=>'Choitro'),array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'collection_amount',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'purpose',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'active',array('Yes'=>'Yes','No'=>'No'),array('class'=>'span1','maxlength'=>3)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
