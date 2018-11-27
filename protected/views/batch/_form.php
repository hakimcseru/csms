<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'batch-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'batch_id',array('class'=>'span5','maxlength'=>32)); ?>

	<div class="control-group <?php echo ($model->hasErrors('batch_start_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'batch_start_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'Batch[batch_start_date]',
				'value'=> $model->batch_start_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span5',
				),
			));
			?>
			<?php echo $form->error($model,'batch_start_date'); ?>
		</div>
	</div>

	<div class="control-group <?php echo ($model->hasErrors('batch_end_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'batch_end_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'Batch[batch_end_date]',
				'value'=> $model->batch_end_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span5',
				),
			));
			?>
			<?php echo $form->error($model,'batch_end_date'); ?>
		</div>
	</div>

	<?php // if($model->isNewRecord): ?>
	<?php echo $form->dropDownListRow($model,'batch_ref_course_pk', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('class'=>'span5','maxlength'=>20)); ?>
	<?php // endif; ?>

	<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',
                               'update'=>'#Student_batch_ref_course_pk',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->dropDownListRow($model,'batch_status', $model->enumBatchStatus, array('class'=>'span5','maxlength'=>3)); ?>

	<?php // if(!$model->isNewRecord): ?>
	<?php // echo $form->textFieldRow($model,'batch_ref_course_name',array('class'=>'span5','maxlength'=>128)); ?>
	<?php // endif; ?>


		<?php // echo $form->textFieldRow($model,'minimum_fees',array('class'=>'span5','maxlength'=>128)); ?>

	<div id="group_div">
	<div class="control-group ">
		<?php echo $form->label($model,Yii::t('core','group'), array('class'=>'control-label')); ?>
		<div class="controls">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'label'=>Yii::t('core','Add Group Name'),
    'loadingText'=>'loading...',
    'htmlOptions'=>array('id'=>'buttonStateful',),
)); ?>
		</div>

	</div>

	<?php if(isset($group))
	{
	 foreach($group as $gp):

	 echo '<div class="control-group"><div class="controls">'.$gp->group_name.'</div></div>';

	 endforeach;
	}

	?>
	</div>

	<div class="actions offset6">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Create Batch') : Yii::t('core','Update Batch'),array('class'=>'btn-primary')); ?>
	</div>
	<script>
	$('#buttonStateful').click(function() {
	$('#group_div').append('<div class="control-group"><div class="controls"><input type="text" id="Course_course_name" name="group[]" value="" maxlength="128" class="span5"></div></div>');

});

</script>
<?php $this->endWidget(); ?>
