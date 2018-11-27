<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty Members')=>array('index'),
	$model->member_name=>array('view','id'=>$model->member_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List FacultyMember','url'=>array('index')),
	array('label'=>'Create FacultyMember','url'=>array('create')),
	array('label'=>'View FacultyMember','url'=>array('view','id'=>$model->member_pk)),
	array('label'=>'Manage FacultyMember','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update'); echo " "; echo Yii::t('core','Faculty Member');?> - <?php echo $model->member_name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>