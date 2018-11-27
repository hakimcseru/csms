<?php
$this->breadcrumbs=array(
	'Auth Users'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List AuthUser','url'=>array('index')),
array('label'=>'Create AuthUser','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auth-user-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Auth Users</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'auth-user-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		//'id',
		'username',
		'password',
		'email',
		'department_id',
		'role_id',
array(

//'class'=>'bootstrap.widgets.TbButtonColumn',
	'class'=>'CButtonColumn',

'template'=>'{view}{update}{delete}',
),
),
)); ?>
