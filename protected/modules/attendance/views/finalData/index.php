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
	$.fn.yiiGridView.update('attendance-final-data-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1><?php echo Yii::t('attendance', 'Manage Processed Data'); ?></h1>

<style type="text/css">
	.grid-view .button-column select{ width: 100%;}
</style>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php echo CHtml::link(Yii::t('attendance', 'Add New Attendance'), Yii::app()->createUrl("attendance/finalData/create"),  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{ modalUpdateUrl='".Yii::app()->createUrl('attendance/finalData/create')."'; modalAjaxForm(); $('#modalAjaxView').modal('show'); return false; }"));?>

<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'attendance-final-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'enableSorting'=>false,
	'selectableRows'=>false,
	'mergeColumns' => array('core_department_id', 'core_shift_id'),
	'extraRowColumns' => array('date'),
	'extraRowExpression'=>'"<strong>".  Bndate::t($data->date, true)."</strong>"',
	'columns'=>array(
		//'date'=>array('name'=>'date', 'value'=>'$data->tdate()', 'visible'=>false),
		'core_employee_id'=>array(
			'name'=>'core_employee_id',
			'type'=>'raw',
			'value'=> 'isset($data->employee)? "<div style=\'text-align:left;\'>
				<img src=\'".$data->employee->getImage(48,48)."\' />".
				$data->employee->name." (".Bndate::t($data->core_employee_id).")</div>" :
				$data->core_employee_name." (".Bndate::t($data->core_employee_id). ")"',
			'filter'=>false,
			),
		'core_department_id'=>array(
			'name'=>'core_department_id',
			'value'=> 'isset($data->department)? $data->department->name : $data->core_department_name',
			'filter'=>  CHtml::listData(CoreDepartment::model()->findAll(), 'id', 'name'),
			),
		'core_shift_id'=>array(
			'name'=>'core_shift_id',
			'value'=> 'isset($data->shift)? $data->shift->name : $data->core_shift_name',
			'filter'=>  CHtml::listData(CoreShift::model()->findAll(), 'id', 'name'),
			),
		//'date'=>array('name'=>'date', 'value'=>'Bndate::t($data->date)', 'filter'=>false),
		'in_time'=>array('type'=>'raw','name'=>'in_time', 'value'=>'empty($data->in_time)? null : $data->getTimeColor($data->status,Bndate::t(date("H:i", strtotime($data->in_time))))', 'filter'=>false),
		'break_start'=>array('name'=>'break_start', 'value'=>'empty($data->break_start)? null : Bndate::t(date("H:i:s", strtotime($data->break_start)))', 'filter'=>false),
		'break_end'=>array('name'=>'break_end', 'value'=>'empty($data->break_end)? null : Bndate::t(date("H:i", strtotime($data->break_end)))', 'filter'=>false),
		'out_time'=>array('name'=>'out_time', 'value'=>'empty($data->out_time)? null : Bndate::t(date("H:i", strtotime($data->out_time)))', 'filter'=>false),
		'status'=>array(
			'name'=>'status',
			'value'=>'$data->status',
                        'type'=>'raw',
			'filter'=>$model->statusList,
                        
		),
		'work_hour'=>array(
			'name'=>'work_hour',
			'value'=>'$data->work_hour? Bndate::t($data->work_hour) : null',
			'filter'=>false,
		),
		'over_time'=>array(
			'name'=>'over_time',
			'value'=>'$data->over_time? Bndate::t($data->over_time) : null',
			'filter'=>false,
		),
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'header'=>CHtml::dropDownList(get_class($model).'_pageSize',Yii::app()->user->getState(get_class($model).'_pageSize'), array(10=>10,20=>20,50=>50,100=>100),array(
				'onchange'=>"$.fn.yiiGridView.update('attendance-final-data-grid',{ data:{".get_class($model)."_pageSize: $(this).val() }})",
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
		$.fn.yiiGridView.update('attendance-final-data-grid');
                }

            } ",
            ))?>;
    return false;

}
</script>