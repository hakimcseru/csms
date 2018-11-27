<?php
$url = CJavaScript::quote($this->createUrl('create'), true);
Yii::app()->clientScript
	->registerCoreScript('jquery')
	->registerScript('attendance-final-data-grid-init', "
$('#attendance-final-data-grid-actions button.action-create').live('click', function(){
	document.location.href = '{$url}';
	return false;
});
	");
$this->menu = array(
	array('label' => 'Attendance Final Datas', 'url' => array('index')),
	array('label' => 'Create attendance final data', 'url' => array('create')),
);
?>
<div class="block">
	<div class="content">
		<h2 class="title">Attendance Final Datas</h2>
		<?php $this->renderPartial('_grid', array(
			'model' => $model,
		)); ?>
	</div>
</div>