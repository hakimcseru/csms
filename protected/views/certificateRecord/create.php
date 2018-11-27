<?php
$this->breadcrumbs=array(
	Yii::t('core','Manage Certificate Records')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List CertificateRecord','url'=>array('index')),
	array('label'=>'Manage CertificateRecord','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Certificate Record')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>