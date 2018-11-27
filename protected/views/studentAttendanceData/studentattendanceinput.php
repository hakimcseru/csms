<?php
$this->breadcrumbs=array(
	Yii::t('core','Class Routines')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List ClassRoutine','url'=>array('index')),
	array('label'=>'Manage ClassRoutine','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Class Routines')?></h1>




<?php if($nf=Yii::app()->user->getFlash('warning'))
{
?>
<div class="alert in alert-block fade alert-error"><a data-dismiss="alert" class="close">×</a>
<?php echo $nf;?>
</div>
<?php }?>
<?php echo $this->renderPartial('_fmform', array('model'=>$model)); ?> 