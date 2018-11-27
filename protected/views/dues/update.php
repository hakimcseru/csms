<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Dues')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List StudentDues','url'=>array('index')),
	array('label'=>'Create StudentDues','url'=>array('create')),
	array('label'=>'View StudentDues','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentDues','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Student Dues')?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>