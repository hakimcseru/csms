<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty Members'),
);

$this->menu=array(
	array('label'=>'Create FacultyMember','url'=>array('create')),
	array('label'=>'Manage FacultyMember','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Faculty Members')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
