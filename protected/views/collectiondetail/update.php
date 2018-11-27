<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Details')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List StudentCollectionDetail','url'=>array('index')),
	array('label'=>'Create StudentCollectionDetail','url'=>array('create')),
	array('label'=>'View StudentCollectionDetail','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentCollectionDetail','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Student Collection Details')?>#<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>