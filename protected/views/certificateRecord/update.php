<?php
$this->breadcrumbs=array(
	'Certificate Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CertificateRecord','url'=>array('index')),
	array('label'=>'Create CertificateRecord','url'=>array('create')),
	array('label'=>'View CertificateRecord','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CertificateRecord','url'=>array('admin')),
);
?>

<h1>Update CertificateRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>