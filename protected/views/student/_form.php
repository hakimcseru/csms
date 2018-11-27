<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'student-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<div class="well">
		<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?>
	</div>

	<?php echo $form->errorSummary($model); ?>

	<ul class="nav nav-pills">
		<li class="active"><a href="#basic" data-toggle="pill"><?php echo Yii::t('core','BASIC INFO');?></a></li>
		<!-- <li><a href="#others" data-toggle="pill">OTHERS INFO</a></li> -->
		<li><a href="#contacts" data-toggle="pill"><?php echo Yii::t('core','CONTACT INFO');?></a></li>
	</ul>

	<div id="studentTab">
	<div class="tab-content">
		<div class="tab-pane active" id="basic">



			<div class="control-group ">
			<label for="Student_student_mother_name" class="control-label">ছবি</label>
				<div class="controls">
				<div id="photo" style="  width:150px; height:200px; border:1px solid #CCC; background-color: #FFF; float: left;" >
				<?php if(isset($model->student_image)){ ?>
				<img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/student/<?php echo $model->student_image;?>" width="150" height="200" />
				<?php } ?>
				</div> <?php
				if($model->student_pk)

				$this->renderPartial('_upload', array('id'=>  $model->student_pk));
			?>
				</div>
			</div>


			<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span6','maxlength'=>16)); ?>

			<?php echo $form->textFieldRow($model,'student_name',array('class'=>'span6','maxlength'=>128)); ?>

			<?php echo $form->textFieldRow($model,'student_father_name',array('class'=>'span6')); ?>

			<?php echo $form->textFieldRow($model,'student_mother_name',array('class'=>'span6')); ?>
			<?php echo $form->textFieldRow($model,'occupation',array('class'=>'span6')); ?>


			<?php echo $form->textFieldRow($model,'student_nationality',array('class'=>'span6','maxlength'=>32)); ?>

			<?php echo $form->radioButtonListInlineRow($model,'student_gender', $model->enumGender, array('class'=>'span6','maxlength'=>6)); ?>

			<?php echo $form->textFieldRow($model,'student_blood_group', array('class'=>'span6','maxlength'=>3)); ?>

			<div class="control-group <?php echo ($model->hasErrors('student_dob'))? 'error' : '' ?>">
				<?php echo $form->label($model,'student_dob', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model' => $model,
						'name' => 'Student[student_dob]',
						'value'=> $model->student_dob,
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
					<?php echo $form->error($model,'student_dob'); ?>
				</div>
			</div>
		</div>
		<?php /* ?>
		<div class="tab-pane" id="others">
			<?php echo $form->textFieldRow($model,'student_pob',array('class'=>'span6','maxlength'=>32)); ?>

			<?php echo $form->textFieldRow($model,'student_profession',array('class'=>'span6','maxlength'=>64)); ?>

			<?php echo $form->textAreaRow($model,'student_qualification',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

			<?php echo $form->textAreaRow($model,'student_reason_of_photography',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

			<?php echo $form->textAreaRow($model,'student_expectation',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>
		</div>
		*/ ?>
		<div class="tab-pane" id="contacts">
			<?php echo $form->textFieldRow($model,'student_email',array('class'=>'span6')); ?>

			<?php //echo $form->textFieldRow($model,'student_fb_id',array('class'=>'span6')); ?>

			<?php echo $form->textFieldRow($model,'student_contact',array('class'=>'span6','maxlength'=>32)); ?>

			<?php echo $form->textAreaRow($model,'student_present_address',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

			<?php echo $form->textAreaRow($model,'student_permanent_address',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

			<?php echo $form->textAreaRow($model,'student_alternate_contact',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>
		</div>
	</div>
	</div>
	<?php Yii::app()->bootstrap->registerTabs('studentTab'); ?>


	<div class="actions offset7">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Add Student'): 'Update Records',array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
