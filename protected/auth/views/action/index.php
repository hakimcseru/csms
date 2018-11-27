<?php
$this->breadcrumbs=array(
	'Auth Actions',
);

$this->menu=array(
array('label'=>'Create AuthAction','url'=>array('create')),
array('label'=>'Manage AuthAction','url'=>array('admin')),
);
?>

<h1>Auth Actions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
