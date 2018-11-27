<h1><?php echo Yii::t('core','Class Routines'); ?></h1>
<?php
$days = array(
    'Sunday'=>'Sunday',
    'Monday'=>'Monday',
    'Tuesday'=>'Tuesday',
    'Wednesday'=>'Wednesday',
    'Thursday'=>'Thursday',
    'Friday'=>'Friday',
    'Saturday'=>'Saturday',
);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'calendar-info-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	

	<?php echo $form->dropDownListRow($model, 'calendar_name', CHtml::listData(CalendarInfo::model()->findAll(array('order' => 'calendar_name')), 'id', 'calendar_name'), array('empty' => 'Select here....',  'maxlength' => 20, 'class'=>'span3', 'style'=>'height:30px;')); ?>
	
	<?php echo $form->dropDownListRow($model,'weekday',$days,array('empty' => 'Select here....',  'maxlength' => 20, 'class'=>'span3', 'style'=>'height:30px;')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Teacher View',
		)); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Room View',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
