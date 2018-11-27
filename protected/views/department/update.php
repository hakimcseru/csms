<?php
$this->breadcrumbs=array(
	Yii::t('core','Department')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Department','url'=>array('index')),
	array('label'=>'Create Department','url'=>array('create')),
	array('label'=>'View Department','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Department','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Department')?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>