<?php $provider = $model->employeeReport(); ?>
<div class="inner" id="attendance-final-data-grid-inner">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'attendance-final-data-grid',
		'summaryText' => 'Attendance Final Datas {start} - {end} of {count}',
		'emptyText' => 'There are no data to display',
		'updateSelector' => '#attendance-final-data-grid-actions .pagination a, #attendance-final-data-grid .table thead th a',
		'afterAjaxUpdate' => "js:function(id, data){var id = '#' + id + '-actions'; \$(id).replaceWith(\$(id, '<div>' + data + '</div>'))}",
		'selectableRows'=>1,
		'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/"+$.fn.yiiGridView.getSelection(id);}',
		'showTableOnEmpty' => true,
		'dataProvider' => $provider,
		//'filter' => $model,
		'cssFile' => false,
		'enableSorting' => false,
		'enablePagination' => false,
		'itemsCssClass' => 'table',
		'pagerCssClass' => 'pagination',
		'template' => '{items}',
		'columns' => array(
			//'attendance_final_data_id',
			array(
				'name' => 'attendance_final_data_date',
				'value' => 'date("D, d M Y",  strtotime($data->attendance_final_data_date))',
				//'footer' => 'Total: '.($provider->itemCount === 0 ? '' : $model->totalRow(' ')),
			),
			array(
				'name' => 'attendance_final_data_status',
				'filter' => $model->enum_attendance_final_data_status,
				'value' => '$data->attendance_final_data_status',
				//'footer'=> $provider->itemCount === 0 ? '' : 'On Leave: '.$model->totalRow(array('LC','LS','LE','LO','LW','LM')),
			),
			array
			(
				'name' => 'attendance_final_data_in_time',
				'value' => '$data->attendance_final_data_in_time',
				//'footer'=> $provider->itemCount === 0 ? '' : 'Late In: '.$model->totalRow('LI '),
			),
			array
			(
				'name' => 'attendance_final_data_out_time',
				'value' => '$data->attendance_final_data_out_time',
				//'footer'=> $provider->itemCount === 0 ? '' : 'Early Out: '.$model->totalRow('EO '),
			),
			array(
				'name' => 'attendance_final_data_over_time',
				'value' => '$data->attendance_final_data_over_time',
				//'footer'=> 'OT Hours: '.($provider->itemCount === 0 ? '0' : $model->totalOT()),
			),
		),
	)); ?>


	<div class="actions-bar wat-cf" id="attendance-final-data-grid-actions">
<!--		<div class="actions">
			<button class="button action-create" type="button">
				<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/create.png', 'Create'); ?> Insert New Data
			</button>
		</div>-->
		<?php $this->widget('application.components.widgets.ELinkPager', array(
			'cssFile' => false,
			'pages' => $provider->getPagination(),
		)); ?>
	</div>
</div>

<div class="freeSpace">&nbsp;</div>

<h2>Report Summery:</h2>
<table class="bodyData2">
	  <tr>
		<td><h3>Total</h3></td>
		<td><?php echo $provider->itemCount === 0 ? '0' : $model->totalRow(' ') ?></td>

	  </tr>
	  <tr>
		<td><h3>On Leave</h3></td>
		<td><?php echo $provider->itemCount === 0 ? '0' : $model->totalRow(array('LC','LS','LE','LO','LW','LM')) ?></td>

	  </tr>
	  <tr>
		<td><h3>Late In</h3></td>
		<td><?php echo $provider->itemCount === 0 ? '0' : $model->totalRow('LI ') ?></td>

	  </tr>
	  <tr>
		<td><h3>Early Out</h3></td>
		<td><?php echo $provider->itemCount === 0 ? '0' : $model->totalRow('EO ') ?></td>

	  </tr>

	  <tr>
		<td><h3>OT Hours</h3></td>
		<td><?php echo $provider->itemCount === 0 ? '0' : $model->totalOT() ?></td>

	  </tr>
	</table>

	<div class="freeSpace">&nbsp;</div>