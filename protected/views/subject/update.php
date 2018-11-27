<?php
$this->breadcrumbs=array(
	Yii::t('core','Subject')=>array('index'),
	Bndate::t($model->subject_pk)=>array('view','id'=>$model->subject_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Subject','url'=>array('index')),
	array('label'=>'Create Subject','url'=>array('create')),
	array('label'=>'View Subject','url'=>array('view','id'=>$model->subject_pk)),
	array('label'=>'Manage Subject','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update')." ".Yii::t('core','Subject');?> <?php echo Bndate::t($model->subject_pk); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>