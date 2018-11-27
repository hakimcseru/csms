<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty Members')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List FacultyMember','url'=>array('index')),
	array('label'=>'Manage FacultyMember','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Faculty Member');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>