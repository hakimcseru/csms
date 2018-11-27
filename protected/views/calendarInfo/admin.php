

<h1><?php echo Yii::t('core','Manage Calendar Infos');?></h1>




<?php
$this->widget(
    'bootstrap.widgets.BootButton',
    array(
        'label' => 'Create',
        'type' => 'primary',
		'url'=>Yii::app()->request->baseUrl.'/calendarInfo/create',
    )
);?>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'calendar-info-grid',
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
		'id',
		'calendar_name',
		'session_id',
		'start_date',
		'end_date',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('calendarInfo/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("calendar-info-grid");
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
