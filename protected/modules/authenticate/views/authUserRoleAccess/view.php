<?php
$this->breadcrumbs=array(
	'Auth User Role Accesses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List AuthUserRoleAccess','url'=>array('index')),
array('label'=>'Create AuthUserRoleAccess','url'=>array('create')),
array('label'=>'Update AuthUserRoleAccess','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete AuthUserRoleAccess','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AuthUserRoleAccess','url'=>array('admin')),
);
?>

<h1>View AuthUserRoleAccess #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'role_id',
		'module',
		'controller',
		'action',
),
)); ?>
