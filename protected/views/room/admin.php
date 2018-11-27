<?php
$this->breadcrumbs=array(
	Yii::t('core','Rooms')=>array('index'),
	Yii::t('core','Manage'),
	
	
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
	array('label'=>'Create Room','url'=>array('create')),
);
?>

<h1><?php echo Yii::t('core','Manage Room');?></h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('room/create'),
)); ?>

<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'room-grid',
	'dataProvider'=>$model->search(),
	'template'=>"{pager}{summary}\n{items}\n{summary}{pager}",
         'pager'=>array(
'header'=>'',
'cssFile'=>false,
'maxButtonCount'=>17,


'firstPageLabel'=>'<<',
'lastPageLabel'=>'>>',
'prevPageLabel'=>'<',
'nextPageLabel'=>'>',
),
	'filter'=>$model,
	'columns'=>array(
		//'room_pk',
//		array(
//			'header'=>'No.',
//			'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
//		),
		'room_no',
		'room_capacity',
		array(
			'name'=> 'room_condition',
			'value'=>'$data->enumRoomCondition[$data->room_condition]',
			'filter'=>$model->enumRoomCondition,
		),
		array(
			'name'=> 'room_type',
			'value'=>'$data->enumRoomType[$data->room_type]',
			'filter'=>$model->enumRoomType,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('room/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("room-grid");
		pos = queryString.indexOf('?',0)
		if(pos == -1)
		{
			queryString = '';
		}
		else
		{
			queryString = queryString.substr(pos);
		}
		$(link).attr("href", baseUrl+queryString);
		//alert($.fn.yiiGridView.getUrl("attendance-final-data-grid"));
	}      
</script>
<td><a class="btn btn-primary" style="margin-right:20px;"  class="btnPrint" href="#" onclick="getUrl(this)" ><?php echo Yii::t('core','Excel Export');?></a></td>

