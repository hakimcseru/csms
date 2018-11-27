<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.1.4.2.js"></script>
<script type="text/javascript">
$(function($) {

$('#All').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('input[type="checkbox"]').prop('checked', true);
		}
		else
		{
	
		$('input[type="checkbox"]').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});


$('#AllView').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('.view').prop('checked', true);
		}
		else
		{
	
		$('.view').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});


$('#AllAdmin').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('.admin').prop('checked', true);
		}
		else
		{
	
		$('.admin').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});


$('#AllCreate').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('.create').prop('checked', true);
		}
		else
		{
	
		$('.create').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});


$('#AllUpdate').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('.update').prop('checked', true);
		}
		else
		{
	
		$('.update').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});



$('#AllDelete').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('.delete').prop('checked', true);
		}
		else
		{
	
		$('.delete').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});



$('#AllIndex').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('.index').prop('checked', true);
		}
		else
		{
	
		$('.index').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});


$('#AllOthers').click(function () {
	 if($(this).is(':checked'))
		{
		
		$('ul.mainul li ul li input[type="checkbox"]:not(.index, .create, .delete, .update, .view, .admin)').prop('checked', true);
		}
		else
		{
	
		$('ul.mainul li ul li input[type="checkbox"]:not(.index, .create, .delete, .update, .view, .admin)').prop('checked', false);
		}
	
    //$(".view").toggle(this.checked);
});

$("ul input:checkbox").change(function(){
   // alert("Robin");
    if ($(this).is(':checked')) {
        // deti
        $(this).parent().find("input:checkbox").attr('checked', 'checked');
    }
    else {
        // deti
        $(this).parent().find("input:checkbox").removeAttr('checked');
        // rodice
        $(this).parents('li').each(function(){
            $(this).children('input:checkbox').removeAttr('checked');
        });
    }
});
});



</script>







<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'auth-user-role-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>250)); ?>
	
	<script type="text/javascript">
	$(function(){
  $("#select_ctrl").click ( function(){
   $("#auth-user-role-form input[type='checkbox'].act").attr ( "checked" , $(this).attr("checked" ) );
  });
});


 </script>
	
	<div class="control-group" style="width:100%;">
		<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:30px;">
		<label class="control-label" >Role Controller</label>
		<div class="controls">
		<?php  if($model->isNewRecord){ 
							echo $this->renderPartial('_role'  /*, array('image_id'=>$model->id)*/); 
							}
				else {
					echo $this->renderPartial('_Urole'   , array('model'=>$model)/*, array('image_id'=>$model->id)*/); 
					}
			 ?>
		</div>
		</div>
		<?php /* echo CHtml::link('Create New Category', "",  // the link for open the dialog
			array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{addCategory(); $('#dialogCategory').dialog('open');}")); */?>
		</div>
	
	
	
	
	

	<?php //echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>3)); ?>
	<?php echo $form->dropDownListRow($model, 'active',
	    array('Yes' => 'Active', 'No' => 'Inactive'),
	 
		array('class'=>'span2')
	); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
