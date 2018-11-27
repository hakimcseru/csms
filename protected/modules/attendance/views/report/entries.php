<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th><?php echo Yii::t('attendance', 'Mode'); ?></th><th><?php echo Yii::t('attendance', 'Time'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if(isset($model->json_log)){
			$logs = json_decode($model->json_log, true);
			$modes = AttendanceTempData::modeList();
			if($logs){
				foreach($logs as $log){
					echo '<tr><td>'. $modes[$log['mode']] .'</td><td>'.  Bndate::t(date('H:i:s', strtotime($log['time']))).'</td></tr>';
				}
			}
		}
		else{
			echo '<tr><td colspan="7"><span>No results found.</span></td></tr>';
		}
		?>
	</tbody>
</table>
