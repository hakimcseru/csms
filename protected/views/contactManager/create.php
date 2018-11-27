<?php
$this->breadcrumbs=array(
	Yii::t('core','Manage Contacts')=>array('manage'),
	Yii::t('core','Create'),
);

$this->renderPartial('_menu', array('active'=>'create'));
?>

<h1><?php echo Yii::t('core','Add New Contact') ?> </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>