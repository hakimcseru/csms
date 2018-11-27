<?php
$this->breadcrumbs=array(
	'Notice Recipients'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NoticeRecipient','url'=>array('index')),
	array('label'=>'Manage NoticeRecipient','url'=>array('admin')),
);
?>

<h1>Create NoticeRecipient</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>