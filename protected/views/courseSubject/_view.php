<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_subject_pk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->course_subject_pk),array('view','id'=>$data->course_subject_pk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_subject_ref_course_pk')); ?>:</b>
	<?php echo CHtml::encode($data->course_subject_ref_course_pk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_subject_ref_subject_pk')); ?>:</b>
	<?php echo CHtml::encode($data->course_subject_ref_subject_pk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_subject_semester_no')); ?>:</b>
	<?php echo CHtml::encode($data->course_subject_semester_no); ?>
	<br />


</div>