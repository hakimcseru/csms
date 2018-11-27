<?php
$this->breadcrumbs=array(
	'Auth User Role Accesses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AuthUserRoleAccess','url'=>array('index')),
	array('label'=>'Create AuthUserRoleAccess','url'=>array('create')),
	array('label'=>'View AuthUserRoleAccess','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AuthUserRoleAccess','url'=>array('admin')),
	);
	?>

	<h1>Update AuthUserRoleAccess <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>