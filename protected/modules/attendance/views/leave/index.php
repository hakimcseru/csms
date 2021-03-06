<?php
$this->breadcrumbs=array(
	'Attendance Temp Datas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AttendanceTempData','url'=>array('index')),
	array('label'=>'Create AttendanceTempData','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('attendance-leave-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1><?php echo Yii::t('attendance', 'Manage Leaves'); ?></h1>

<style type="text/css">
	.grid-view .button-column select{ width: 100%;}
</style>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php echo CHtml::link(Yii::t('attendance', 'Add New Leave'), Yii::app()->createUrl("attendance/leave/create"),  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{ modalUpdateUrl='".Yii::app()->createUrl('attendance/leave/create')."'; modalAjaxForm(); $('#modalAjaxView').modal('show'); return false; }"));?>

<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'attendance-leave-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'enableSorting'=>false,
	'selectableRows'=>false,
	'mergeColumns' => array('core_employee_id', 'start_date', 'end_date'),
	//'extraRowColumns' => array('date'),
	//'extraRowExpression'=>'"<strong>".$data->tdate()."</strong>"',
	'columns'=>array(
		//'date'=>array('name'=>'date', 'value'=>'$data->tdate()', 'visible'=>false),
		'core_employee_id'=>array(
			'name'=>'core_employee_id',
			'type'=>'raw',
			'value'=> '"<div style=\'text-align:left;\'>
				<img src=\'".$data->employee->getImage(48,48)."\' />".
				$data->employee->name." (".Bndate::t($data->core_employee_id).")</div>"',
			'filter'=>false,
			),
		'start_date'=>array('name'=>'start_date', 'value'=> 'Bndate::t($data->start_date, true)'),
		'end_date'=>array('name'=>'end_date', 'value'=>'Bndate::t($data->end_date, true)'),
		'duration'=>array('name'=>'duration', 'value'=>'Bndate::t($data->duration)'),
		'type'=>array('name'=>'type', 'value'=>'$data->types[$data->type]'),
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'header'=>CHtml::dropDownList(get_class($model).'_pageSize',Yii::app()->user->getState(get_class($model).'_pageSize'), array(10=>10,20=>20,50=>50,100=>100),array(
				'onchange'=>"$.fn.yiiGridView.update('attendance-leave-grid',{ data:{".get_class($model)."_pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}{delete}',
			'buttons'=>array
			(
				'view' => array
				(
					//'url'=>'Yii::app()->createUrl("attendance/tempData/view", array("id"=>$data->id))',
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								msg = eval('(' + data + ')');
								$('#modalAjaxView div.modal-body').html(msg.div);
								$('#modalAjaxView').modal();
								//setTimeout(\"$('#dialogInboxView').dialog('close') \",2000);

							} ",
						 ),
					   ),
				),
				'update' => array
				(
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								data = eval('(' + data + ')');
								modalUpdateUrl=data.url;
								$('#modalAjaxView div.modal-body').html(data.div);
								$('#modalAjaxView div.modal-body form').submit(modalAjaxForm);
								$('#modalAjaxView').modal('show');
								//setTimeout(\"$('#dialogInboxView').dialog('close') \",2000);

							} ",
						 ),
					   ),
				),
			),
		)
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modalAjaxView')); ?>
<div class="modal-body"></div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
	var modalUpdateUrl;
// here is the magic
function modalAjaxForm()
{
	//alert(url);
    <?php echo CHtml::ajax(array(
            'url'=>  "js:modalUpdateUrl",
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#modalAjaxView div.modal-body').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#modalAjaxView div.modal-body form').submit(modalAjaxForm);
                }
                else
                {
                    $('#modalAjaxView div.modal-body').html(data.div);
                    setTimeout(\"$('#modalAjaxView').modal('hide') \",2000);
		$.fn.yiiGridView.update('attendance-leave-grid');
                }

            } ",
            ))?>;
    return false;

}
</script>