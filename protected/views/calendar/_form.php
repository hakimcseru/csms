<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'calendar-form',
	//'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,

)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'calendar_pk'); ?>
	<?php echo $form->textFieldRow($model,'calendar_ref_room_pk',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'calendar_ref_room_no',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'calendar_title',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'calendar_description',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<div class="control-group <?php echo ($model->hasErrors('calendar_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'calendar_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'Calendar[calendar_date]',
				'value'=> $model->calendar_date,
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
			<?php echo $form->error($model,'calendar_date'); ?>
		</div>
	</div>

	<?php echo $form->textFieldRow($model,'calendar_start_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'calendar_end_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'calendar_link',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'calendar_reference',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->dropDownListRow($model,'calendar_day', $model->enumCalendarDay, array('empty'=>'','class'=>'span5','maxlength'=>32)); ?>

	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
