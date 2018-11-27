<?php
$this->breadcrumbs=array(
	'Auth User Role Accesses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AuthUserRoleAccess','url'=>array('index')),
array('label'=>'Manage AuthUserRoleAccess','url'=>array('admin')),
);
?>

<h1>Create AuthUserRoleAccess</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>