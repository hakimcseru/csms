<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'calendar-info-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'calendar_name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'start_date',array('class'=>'span5')); ?>
	<div class="control-group <?php echo ($model->hasErrors('date_of_deposit'))? 'error' : '' ?>">
		<?php echo $form->label($model,'start_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'CalendarInfo[start_date]',
				'value'=> $model->start_date,
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
			<?php echo $form->error($model,'start_date'); ?>
		</div>
	<?php // echo $form->textFieldRow($model,'date_of_deposit',array('class'=>'span6')); ?>
	
	</div>
	
	<div class="control-group <?php echo ($model->hasErrors('end_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'end_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'CalendarInfo[end_date]',
				'value'=> $model->end_date,
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
			<?php echo $form->error($model,'end_date'); ?>
		</div>
	<?php // echo $form->textFieldRow($model,'date_of_deposit',array('class'=>'span6')); ?>
	
	</div>

	<?php //echo $form->textFieldRow($model,'end_date',array('class'=>'span5')); ?>
	
	<?php //echo $form->textFieldRow($model,'copyfrom',array('class'=>'span5','maxlength'=>250)); ?>
	
	<?php echo $form->dropDownListRow($model,'copyfrom', CHtml::listData(calendarInfo::model()->findAll(), 'id', 'calendar_name'), array('empty' => 'Select Calendar','class'=>'span5','maxlength'=>20)); ?>
	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
