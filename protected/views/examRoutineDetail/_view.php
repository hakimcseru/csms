<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('faculty_member_id')); ?>:</b>
	<?php echo CHtml::encode($data->faculty_member_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_section_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch_section_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_id')); ?>:</b>
	<?php echo CHtml::encode($data->room_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exam_date_id')); ?>:</b>
	<?php echo CHtml::encode($data->exam_date_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_faculty_member_id')); ?>:</b>
	<?php echo CHtml::encode($data->additional_faculty_member_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weekday')); ?>:</b>
	<?php echo CHtml::encode($data->weekday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exam_routine_id')); ?>:</b>
	<?php echo CHtml::encode($data->exam_routine_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester_id')); ?>:</b>
	<?php echo CHtml::encode($data->semester_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_id')); ?>:</b>
	<?php echo CHtml::encode($data->subject_id); ?>
	<br />

	*/ ?>

</div>