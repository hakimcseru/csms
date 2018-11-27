<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'room_pk',
		'room_no',
		'room_description',
		'room_capacity',
		'room_condition',
		'room_type',
	),
)); ?>