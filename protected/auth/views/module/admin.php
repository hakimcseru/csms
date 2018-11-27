<?php
$this->breadcrumbs=array(
	'Auth Modules',
);

$this->menu=array(
array('label'=>'List AuthModule','url'=>array('index')),
array('label'=>'Create AuthModule','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auth-module-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Auth Modules</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'auth-module-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		//'id',
		'name',
		'active',
array(
//'class'=>'bootstrap.widgets.TbButtonColumn',
'class'=>'CButtonColumn',
'template'=>'{view}{update}{delete}',
),
),
)); ?>
