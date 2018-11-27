<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'attendance-calendar-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span7 datepicker')); ?>
	
	
	
	

	<?php echo $form->dropDownListRow($model,'type', $model->types, array('class'=>'span7','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span7','maxlength'=>64)); ?>

	
	
	
	<?php echo $form->textFieldRow($model,'note',array('class'=>'span7','maxlength'=>256)); ?>
	
	
	
 <?php echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('class'=>'span5','maxlength'=>20)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('attendance', 'Create') : Yii::t('attendance', 'Save'),
		)); ?>
	</div>
	
	

<?php $this->endWidget(); ?>
<?php $this->widget('application.widgets.timepicker.registerScript', array()); ?>

<script>
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
});
</script>