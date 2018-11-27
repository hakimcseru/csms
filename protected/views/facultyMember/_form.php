<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'faculty-member-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

<div class="well">
		<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?>
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
			<label for="FacultyMember_member_mother_name" class="control-label">ছবি</label>
				<div class="controls">
				<div id="photo" style="  width:100px; height:100px; border:1px solid #CCC; background-color: #FFF; float: left;" >
				<?php if(isset($model->member_image)){ ?>
				<img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/faculty/<?php echo $model->member_image;?>" width="100" height="100" />
				<?php } ?>
				</div> <?php
				if($model->member_pk)

				$this->renderPartial('_upload', array('id'=>  $model->member_pk));
			?>
				</div>
			</div>

			<?php echo $form->dropDownListRow($model,'faculty_id', CHtml::listData(Faculty::model()->findAll(), 'id', 'faculty_name'),array('class'=>'span6')); ?>

			<?php echo $form->dropDownListRow($model,'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'department_name'),array('empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>

			<?php echo $form->textFieldRow($model,'member_id',array('class'=>'span6','maxlength'=>16)); ?>

			<?php echo $form->textFieldRow($model,'member_name',array('class'=>'span6','maxlength'=>128)); ?>
			
			<?php echo $form->textFieldRow($model,'designation',array('class'=>'span6','maxlength'=>128)); ?>
			
			<?php echo $form->textFieldRow($model,'member_father_name',array('class'=>'span6')); ?>

			<?php echo $form->textFieldRow($model,'member_mother_name',array('class'=>'span6')); ?>
			<?php echo $form->textFieldRow($model,'member_profession',array('class'=>'span6')); ?>


			<?php echo $form->textFieldRow($model,'member_nationality',array('class'=>'span6','maxlength'=>32)); ?>

			<?php echo $form->radioButtonListInlineRow($model,'member_gender', $model->enumGender, array('class'=>'span6','maxlength'=>6)); ?>

			<?php echo $form->textFieldRow($model,'member_blood_group', array('class'=>'span6','maxlength'=>3)); ?>

			<div class="control-group <?php echo ($model->hasErrors('member_dob'))? 'error' : '' ?>">
				<?php echo $form->label($model,'member_dob', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model' => $model,
						'name' => 'FacultyMember[member_dob]',
						'value'=> $model->member_dob,
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
					<?php echo $form->error($model,'member_dob'); ?>
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
			<?php echo $form->textFieldRow($model,'member_email',array('class'=>'span6')); ?>

			<?php //echo $form->textFieldRow($model,'member_fb_id',array('class'=>'span6')); ?>

			<?php echo $form->textFieldRow($model,'member_contact',array('class'=>'span6','maxlength'=>32)); ?>

			<?php echo $form->textAreaRow($model,'member_present_address',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

			<?php echo $form->textAreaRow($model,'member_permanent_address',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

			<?php echo $form->textAreaRow($model,'member_alternate_contact',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>
		</div>
	</div>
	</div>
	<?php Yii::app()->bootstrap->registerTabs('studentTab'); ?>


	<div class="actions offset7">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('core','Add Faculty Member') :  Yii::t('core','Update Records'),array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
