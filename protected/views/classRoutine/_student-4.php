

<style>
	body{
	
    padding:0;	
    font-family:SolaimanLipi;
    }
 	h4{margin:0; padding:0; font-size:15px; text-align:center; color:#333}
	.routine_tbl{border-collapse:collapse; border-spacing:0; color:#333; font-size:22px}
	.routine_tbl tr th{padding:8px; background-color:#fafafa; text-align:center; font-weight:bold; border:1px solid #333; vertical-align:middle}
	.routine_tbl tr td{padding:8px; text-align:center; border:1px solid #333;}
	.routine_tbl tr td div{line-height:22px}
</style>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><h1 style="text-align:center;margin-bottom:0 !important;"><?php echo $department_name;?></h1></td>
  </tr>
  
  <tr>
    <td><h2 style="text-align:center; margin-bottom:0 !important;">শ্রেণি: <?php echo $semester_name;?></h2></td>
  </tr>
  <tr>
    <td><h2 style="text-align:center; margin-bottom:0 !important;"><h2 style="text-align:center; margin-bottom:0 !important;"><?php echo Bndate::BanglaWeekDay($weekdayw['weekday']);?></h2></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="routine_tbl">
		
          <tr>
		  <?php foreach($cperiod as $per):?>
            <th><?php 
			$cp=ClassPeriod::model()->findByPk($per['class_period_id']);
			
			echo Bndate::t(date("A h:i",strtotime($cp->start_time)))." - ".Bndate::t(date("h:i",strtotime($cp->end_time)));?></th>
			<?php endforeach;?>
           
          </tr>
          <tr>
		  <?php foreach($cperiod as $per):
			$srr=ClassRoutine::model()->find($where." and class_period_id=".$per['class_period_id']);
			
			?>
            <td>
            	<div><?php echo $srr->subject->subject_name;?></div>
                <div><?php echo $srr->facultyMember->member_name;?></div>
                <div><?php echo $srr->A_facultyMember?$srr->A_facultyMember->member_name:"";?></div>
                <div><?php echo $srr->room->room_no;?></div>
            </td>
			<?php endforeach;?>
            
            
           
          </tr>
        </table>
    </td>
  </tr>
</table>

