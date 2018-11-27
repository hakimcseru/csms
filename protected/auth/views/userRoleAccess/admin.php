<?php
$this->breadcrumbs=array(
	'Auth User Role Accesses',
);

$this->menu=array(
array('label'=>'List AuthUserRoleAccess','url'=>array('index')),
array('label'=>'Create AuthUserRoleAccess','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auth-user-role-access-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Auth User Role Accesses</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'auth-user-role-access-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'role_id',
		'module',
		'controller',
		'action',
array(
//'class'=>'bootstrap.widgets.TbButtonColumn',
'class'=>'CButtonColumn',

'template'=>'{view}{update}{delete}',

),
),
)); ?>
