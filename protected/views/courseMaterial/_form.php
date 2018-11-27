
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/fileuploader.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fileuploader.js'); ?>


<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'type'=>'horizontal',
	'id'=>'course-material-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'doc_title',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textAreaRow($model,'doc_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textAreaRow($model,'session_id',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->dropDownListRow($model,'session_id', array('1420'=>'1420','1421'=>'1421','1422'=>'1422','1423'=>'1423'),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Session'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_course_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
		<?php  if($model->isNewRecord) echo $form->dropDownListRow($model,'course_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20));
else
echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20));								?>
								
	<?php  if($model->isNewRecord) echo $form->dropDownListRow($model,'department_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); 
	else							
	echo $form->dropDownListRow($model,'department_id', CHtml::listData(CourseDepartment::model()->findAll("course_id=".$model->course_id),'department.id', 'department.department_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20));
								?>
								
	<?php 
	 if($model->isNewRecord){	echo $form->dropDownListRow($model,'batch_id',array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20));	}
	
	else
	
	echo $form->dropDownListRow($model,'batch_id', CHtml::listData(Batch::model()->findAll(), 'batch_pk', 'batch_id'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_group_id',
                                )),'empty' => 'Select Batch','class'=>'span5','maxlength'=>20)); ?>
	<?php  //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>
	<?php //echo $form->textFieldRow($model,'group_id',array('class'=>'span5')); ?>
	<?php if($model->isNewRecord){			
		echo $form->dropDownListRow($model,'group_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_semester_id',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); 						
								
								}
	else 
	{ echo $form->dropDownListRow($model,'group_id', CHtml::listData(BatchGroup::model()->findAll("batch_id=".$model->batch_id), 'id', 'group_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Cemester'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_semester_id',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); }
			
								?>

	<?php // echo $form->textFieldRow($model,'semester_id',array('class'=>'span5')); ?>
	<?php if($model->isNewRecord) echo $form->dropDownListRow($model,'semester_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Subject'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_subject_id',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20)); 
	else
	echo $form->dropDownListRow($model,'semester_id', CHtml::listData(CourseSemesterLebel::model()->findAll('course_id='.$model->course_id ),'semester_id','lebel'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Subject'),
                                'type' => 'POST',                     
                               'update'=>'#CourseMaterial_subject_id',
                                )),'empty' => 'Select Batch Group','class'=>'span5','maxlength'=>20));

								?>

	<?php //echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>
<?php if($model->isNewRecord)echo $form->dropDownListRow($model,'subject_id', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>
	<?php //echo $form->textFieldRow($model,'subject_id',array('class'=>'span5')); ?>
	<?php //echo $form->dropDownListRow($model,'subject_id',CHtml::listData(Subject::model()->findAll(), 'subject_pk', 'subject_name'),array('class'=>'span5', 'maxlength'=>20)); ?>
	<?php /*$models = Subject::model()->findAll();
$data = array();

foreach ($models as $model1)
    $data[$model1->subject_pk] = $model1->subject_name . ' ('. $model1->subject_code.')';     

echo $form->dropDownListRow($model, 'subject_id', $data ,array('prompt' => 'Select','class'=>'span5', 'maxlength'=>20)); */?>

	<?php echo $form->textFieldRow($model,'file_location',array('class'=>'span5','maxlength'=>250,'readonly'=>true)); ?>
	<!--<div class="control-group ">
		<label for="CourseMaterial_file_location" class="control-label required">File Location <span class="required">*</span></label>
			<div class="controls">
				<?php //$this->renderPartial('_upload'); ?>
				<div id="uploaded_files"></div>
			</div>
	</div>-->
	<div class="control-group ">
	<label  class="control-label">Select File</label>
	<div class="controls">
	<div id="file-uploader">
				<noscript>
					<tr><td>Please enable JavaScript to use file uploader.</td></tr>
					
				</noscript>
				</div>
				<script type="text/javascript">
				function createUploader(){
					var uploader = new qq.FileUploader({
						element: document.getElementById('file-uploader'),
						multiple: false,
						//action: '<?php echo $this->createUrl('resources/create')?>',
						action: '<?= $this->createUrl('courseMaterial/upload')?>',
						allowedExtensions: ['jpg','jpeg','gif','tif','doc','docx','txt','pdf','xls','xlsx','zip','rar','zipx','dxf','dwg','pptx','ppt'],
						debug: true,
						onComplete: function(id, fileName, responseJSON){
						
							$('#CourseMaterial_file_location').val(fileName);
						}
					})
				}
				window.onload = function(){
					createUploader();
					}
				</script>
	
	
	</div>
	</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
