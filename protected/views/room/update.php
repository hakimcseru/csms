<?php
$this->breadcrumbs=array(
	Yii::t('core','Rooms')=>array('index'),
	Bndate::t($model->room_pk)=>array('view','id'=>$model->room_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
	array('label'=>'Create Room','url'=>array('create')),
	array('label'=>'View Room','url'=>array('view','id'=>$model->room_pk)),
	array('label'=>'Manage Room','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Rooms')?> <?php echo Bndate::t($model->room_pk); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>