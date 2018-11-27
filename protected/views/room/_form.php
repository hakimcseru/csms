<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'room-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'room_no',array('class'=>'span4','maxlength'=>32)); ?>
       
        <?php echo $form->textFieldRow($model,'room_name',array('class'=>'span4','maxlength'=>50)); ?>
        

	<?php echo $form->textAreaRow($model,'room_description',array('rows'=>5, 'cols'=>50, 'class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'room_capacity',array('class'=>'span4')); ?>

	<?php echo $form->dropDownListRow($model,'room_condition', $model->enumRoomCondition , array('class'=>'span4','maxlength'=>16)); ?>

	<?php echo $form->dropDownListRow($model,'room_type', $model->enumRoomType, array('class'=>'span4','maxlength'=>16)); ?>

	<div class="actions offset5">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
