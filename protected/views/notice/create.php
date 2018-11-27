<?php
$this->breadcrumbs=array(
Yii::t('core','NOTICE')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Notice','url'=>array('index')),
	array('label'=>'Manage Notice','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Notice')?></h1>

<div class="span11 well">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div class="span6 well">
<?php 
$model2 = new StudentEnrollmentInfo;
echo $this->renderPartial('_nform', array('model'=>$model2)); ?>
</div> 


<div class="span5 well">
<?php 
$model2 = new FacultyMember;
echo $this->renderPartial('_fmform', array('model'=>$model2)); ?>
</div>
