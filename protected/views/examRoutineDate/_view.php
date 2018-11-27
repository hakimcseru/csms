<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exam_routine_id')); ?>:</b>
	<?php echo CHtml::encode($data->exam_routine_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exam_date')); ?>:</b>
	<?php echo CHtml::encode($data->exam_date); ?>
	<br />


</div>