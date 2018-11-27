<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'calendar_pk',
		'calendar_ref_room_pk',
		'calendar_ref_room_no',
		'calendar_title',
		'calendar_description',
		'calendar_date',
		'calendar_start_time',
		'calendar_end_time',
		'calendar_link',
		'calendar_reference',
	),
)); ?>