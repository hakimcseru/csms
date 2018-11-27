<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session')); ?>:</b>
	<?php echo CHtml::encode($data->session); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_limit')); ?>:</b>
	<?php echo CHtml::encode($data->start_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_limit')); ?>:</b>
	<?php echo CHtml::encode($data->end_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('result')); ?>:</b>
	<?php echo CHtml::encode($data->result); ?>
	<br />


</div>