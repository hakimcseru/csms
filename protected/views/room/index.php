<?php
$this->breadcrumbs=array(
	Yii::t('core','Rooms')=>array('index'),
);

$this->menu=array(
	array('label'=>'Create Room','url'=>array('create')),
	array('label'=>'Manage Room','url'=>array('admin')),
);
?>

<h1>Rooms</h1>


<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
