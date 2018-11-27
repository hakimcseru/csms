<?php
$this->breadcrumbs=array(
	'Auth Controllers',
);

$this->menu=array(
array('label'=>'List AuthController','url'=>array('index')),
array('label'=>'Create AuthController','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auth-controller-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Auth Controllers</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'auth-controller-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'module_id',
		'name',
		'active',
array(
//'class'=>'bootstrap.widgets.TbButtonColumn',
'class'=>'CButtonColumn',
'template'=>'{view}{update}{delete}',

),
),
)); ?>
