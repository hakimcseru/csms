


<?php
/* @var $employee CoreEmployee */
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$.fn.yiiGridView.update('user-grid', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
?>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="inner" id="noprint">
	<h2 class="title">Employee Report</h2>
	<?php $this->renderPartial('_employeeForm',array(
		'model'=>$model,
	)); ?>
</div>

<?php if(isset ($employee)) {?>
<div style="text-align: center;">




	<table width="100%" class="headData">
	  <tr>
	  <td align="left"><h2>HOPLUN APPARELS LTD.</h2>
		<span>WE ARE COMMITED TO SA-8000</span></td>
		<td>Attendance Report</td>
		<td><?php echo date('d F Y') ?></td>
		
		<td> </td>
		<td> </td>
	  </tr>
	</table>

	<table width="100%" class="bodyData">
	  <tr>
		<td><h3>Employee ID</h3></td>
		<td> <?php echo $employee->core_employee_id;?></td>
		<td><h3>Name</h3></td>
		<td><?php echo $employee->core_employee_name; ?></td>
	  </tr>
	  <tr>
		<td><h3>Designation</h3></td>
		<td> </td>
		<td><h3>Department</h3></td>
		<td><?php echo $employee->department->core_department_name; ?></td>
	  </tr>
	  <tr>
		<td><h3>Shift</h3></td>
		<td><?php echo $employee->shift->core_shift_name; ?></td>
		<td><h3>Line No </h3></td>
		<td> </td>
	  </tr>
	  <tr>
		<td><h3>Date Range</h3></td>
		<td><?php echo $model->attendance_final_data_date_from; ?> to <?php echo $model->attendance_final_data_date_to ?></td>
		<td><h3>Status</h3></td>
		<td> </td>
	  </tr>
	</table>







</div>
<div class="block">
	<div class="content">
		<?php $this->renderPartial('_employeeGrid', array(
			'model' => $model,
		)); ?>
		
		
		
		
	</div>
	<h2 id="noprint" class="title" style="text-align: right;"><a class="btnPrint" href="#" onclick="javascript:window.print(); return false;" ><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/icon_print.png" width="16" height="16" />Print Report</a></h2>
</div>
<?php } ?>