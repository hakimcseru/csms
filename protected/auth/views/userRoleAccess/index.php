<?php
$this->breadcrumbs=array(
	'Auth User Role Accesses',
);

$this->menu=array(
array('label'=>'Create AuthUserRoleAccess','url'=>array('create')),
array('label'=>'Manage AuthUserRoleAccess','url'=>array('admin')),
);
?>

<h1>Auth User Role Accesses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
