<?php
$this->breadcrumbs=array(
	'Auth User Roles',
);

$this->menu=array(
array('label'=>'Create AuthUserRole','url'=>array('create')),
array('label'=>'Manage AuthUserRole','url'=>array('admin')),
);
?>

<h1>Auth User Roles</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
