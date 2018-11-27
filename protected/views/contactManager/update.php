<?php
$this->breadcrumbs=array(
	Yii::t('core','Contact Manager')=>array('manage'),
	Bndate::t($model->contact_pk)=>array('view','id'=>$model->contact_pk),
	Yii::t('core','Update'),
);

$this->renderPartial('_menu', array('active'=>'manage'));
?>

<h1><?php echo Yii::t('core','Update Contact')?> <?php echo Bndate::t($model->contact_pk); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>