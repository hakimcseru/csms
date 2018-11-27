<?php
$this->breadcrumbs=array(
	'Exam Results'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExamResult','url'=>array('index')),
	array('label'=>'Create ExamResult','url'=>array('create')),
	array('label'=>'View ExamResult','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ExamResult','url'=>array('admin')),
);
?>

<h1>Update ExamResult <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>