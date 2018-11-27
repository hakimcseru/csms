<?php
$this->breadcrumbs=array(
	'Notice Recipients'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NoticeRecipient','url'=>array('index')),
	array('label'=>'Create NoticeRecipient','url'=>array('create')),
	array('label'=>'View NoticeRecipient','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage NoticeRecipient','url'=>array('admin')),
);
?>

<h1>Update NoticeRecipient <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>