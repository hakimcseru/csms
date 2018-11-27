<?php
$this->breadcrumbs=array(
	'Notice Recipients',
);

$this->menu=array(
	array('label'=>'Create NoticeRecipient','url'=>array('create')),
	array('label'=>'Manage NoticeRecipient','url'=>array('admin')),
);
?>

<h1>Notice Recipients</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
