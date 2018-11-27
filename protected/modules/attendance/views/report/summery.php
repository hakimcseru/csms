<div class="chart">
<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
   'credits' => array('enabled' => false),
   //'theme' => 'grid',
      'title' => array('text' => 'Attendance of last day'),
      'series' => array(
		array('type' => 'pie',
			  'name' => 'Pie Chart',
			  'data' => array(
				  array('Regular',(int)$lastDayAttendanceSummery['regular']),
				  array('Absent',(int)$lastDayAttendanceSummery['absent']),
				  array('Late In',(int)$lastDayAttendanceSummery['late_in']),
				  array('Early Out',(int)$lastDayAttendanceSummery['early_out']),
				  array('On Leave',(int)$lastDayAttendanceSummery['on_leave']),
				)
			  )
			)
		)
	)
);
?>

</div>

<div class="chart">
<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
	  'chart'=> array('defaultSeriesType' => 'column'),
      'title' => array('text' => 'OT summery of last 30 days'),
	   'credits' => array('enabled' => false),
      'xAxis' => array(
         'categories' => $monthlyDepartmentalOT['department'],
      ),
      'yAxis' => array(
         'title' => array('text' => 'Hours')
      ),
      'series' => array(
         array('name' => 'Department', 'data' => $monthlyDepartmentalOT['OT']),
      )
   )
));
?>
</div>

<div class="clear">&nbsp;</div>


<div class="chart2">
<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
	  'chart'=> array('defaultSeriesType' => 'column'),
      'title' => array('text' => 'Attendance summery of last 30 days'),
	   'credits' => array('enabled' => false),
      'xAxis' => array(
         'categories' => $monthlyDepartmentalAttendance['department'],
      ),
      'yAxis' => array(
         'title' => array('text' => 'Percentage')
      ),
	  'plotOptions' => array(
         'column' =>array(
            'stacking' => 'percent',
         ),
      ),
      'series' => array(
         array('name' => 'Regular', 'data' => $monthlyDepartmentalAttendance['regular']),
		  array('name' => 'Absent', 'data' => $monthlyDepartmentalAttendance['absent']),
		  array('name' => 'Late In', 'data' => $monthlyDepartmentalAttendance['late_in']),
		  array('name' => 'Early Out', 'data' => $monthlyDepartmentalAttendance['early_out']),
		  array('name' => 'On Leave', 'data' => $monthlyDepartmentalAttendance['on_leave']),
      )
   )
));
?>

</div>