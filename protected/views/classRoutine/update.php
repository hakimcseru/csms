<?php
$this->breadcrumbs=array(
	'Class Routines'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClassRoutine','url'=>array('index')),
	array('label'=>'Create ClassRoutine','url'=>array('create')),
	array('label'=>'View ClassRoutine','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ClassRoutine','url'=>array('admin')),
);
?>

<h1>Update ClassRoutine <?php echo $model->id; ?></h1>

<?php if($nf=Yii::app()->user->getFlash('warning'))
{
?>
<div class="alert in alert-block fade alert-error"><a data-dismiss="alert" class="close">×</a>
<?php echo $nf;?>
</div>
<?php }?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>