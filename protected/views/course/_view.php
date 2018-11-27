<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_pk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->course_pk),array('view','id'=>$data->course_pk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_name')); ?>:</b>
	<?php echo CHtml::encode($data->course_name); ?>
	<br />


</div>