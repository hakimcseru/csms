<?php
$this->breadcrumbs=array(
	'Auth Modules',
);

$this->menu=array(
array('label'=>'Create AuthModule','url'=>array('create')),
array('label'=>'Manage AuthModule','url'=>array('admin')),
);
?>

<h1>Auth Modules</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
