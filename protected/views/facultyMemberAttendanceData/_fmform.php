


<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'class-routine-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>
	
	
	
		<?php /* echo $form->dropDownListRow($model,'session_id', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Session'),
                                'type' => 'POST',                     
                               'update'=>'#ClassRoutine_course_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); */?>
								
								
<?php echo $form->dropDownListRow($model,'session_id', CHtml::listData(ClassRoutine::model()->findAll(), 'session_id', 'session_id'), array('empty' => 'Select Session','class'=>'span5','maxlength'=>20)); 
		
								?>
								
<?php echo $form->dropDownListRow($model,'weekday', CHtml::listData(ClassRoutine::model()->findAll(), 'weekday', 'weekday'), array('empty' => 'Select Weekday','class'=>'span5','maxlength'=>20));
								?>								
								
	<div class="control-group <?php echo ($model->hasErrors('start_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'start_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'ClassRoutine[start_date]',
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
		</div>
		
		<div class="control-group <?php echo ($model->hasErrors('end_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'end_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'ClassRoutine[end_date]',
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
		
	<?php // echo $form->textFieldRow($model,'start_date',array('class'=>'span6')); ?>
	
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save') ,
		)); ?>
	
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Print') : Yii::t('core','Print') ,
		)); ?>
	</div>
	

<?php $this->endWidget(); ?>
