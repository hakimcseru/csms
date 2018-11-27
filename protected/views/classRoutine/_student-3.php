
<style>
	body{
	
    padding:0;	
    font-family:SolaimanLipi;
    }
 	h4{margin:0; padding:0; font-size:15px; text-align:center; color:#333}
	.routine_tbl{border-collapse:collapse; border-spacing:0; color:#333; font-size:18px}
	.routine_tbl tr th{padding:8px; background-color:#fafafa; text-align:center; font-weight:bold; border:1px solid #333; vertical-align:middle}
	.routine_tbl tr td{padding:8px; text-align:center; border:1px solid #333; }
	.routine_tbl tr td div{line-height:22px}
	.no_padding{padding:0 !important; border:0 !important}
	.ht{height:150px !important;}
	.bdr_left{border-left:2px solid #333 !important}
	
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
    	<h1 style="text-align:center;margin-bottom:0 !important;"><?php echo $course_name.", ".$department_name;?></h1>
    </td>
  </tr>
  <tr>
    <td>
    	<h2 style="text-align:center;margin-bottom:0 !important;">শ্রেণি: <?php echo $semester_name;?></h2>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="routine_tbl">
         
		  <tr>
		   <?php 
		   $i=1;
		   foreach ($cgroup as $cg):
            
            echo '<th ';
			if($i>1) echo 'class="bdr_left"';
			echo '>';
			echo Bndate::BanglaWeekDay($cg['weekday']);
			echo '</th>';
			$i++;
			endforeach;
			
			?>
          </tr>
          <tr>
		  <?php 
		   $i=1;
		   //print_r($cgroup);
		   //echo $where;
		   foreach ($cgroup as $cg):
		   
		   $connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where and weekday='".$cg['weekday']."' ORDER BY class_period.start_time asc");
			$cperiod = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where and weekday='".$cg['weekday']."' order by batch_section_id");
			$groupA = $command->queryAll();
		   ?>
            <td class="no_padding">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="routine_tbl">
                  <tr>
				  <?php  if($i==1) {?>
                    <td><strong>শাখা</strong></td>
					<?php  }?>
					<?php foreach($cperiod as $per):?>
                   <th><?php 
						$cp=ClassPeriod::model()->findByPk($per['class_period_id']);
						
						echo Bndate::t(date("A h:i",strtotime($cp->start_time)))." - ".Bndate::t(date("h:i",strtotime($cp->end_time)));?></th>
						<?php endforeach;?>
                  </tr>
				  <?php foreach($groupA as $gp):
				   $bss=BatchSection::model()->findByPk($gp['batch_section_id']);
				  
				  ?>
                  <tr>
				  <?php if($i==1) {?>
                    
                    	<td class="ht">
							<div>শাখা: <?php echo $bss->section_name;?></div>
							<div>ক্রম: <?php echo Bndate::t($bss->start_role)." - ".Bndate::t($bss->end_role);?></div>
						</td>
               
                   
					<?php  }?>
                    <?php foreach($cperiod as $per):
					$srr=ClassRoutine::model()->find($where." and batch_section_id=".$gp['batch_section_id']." and weekday='".$cg['weekday']."' and class_period_id=".$per['class_period_id']);
					
					?>
					<td class="ht">
					<?php if($srr)
					{?>
						<div><?php echo $srr->subject?$srr->subject->subject_name:"";?></div>
						<div><?php echo $srr->facultyMember->member_name;?></div>
						<div><?php echo $srr->A_facultyMember?$srr->A_facultyMember->member_name:"";?></div>
						<div><?php echo $srr->room->room_no;?></div>
					
					<?php } ?>
					</td>
<?php					endforeach;?>
                    
                    
                  </tr>
				  <?php endforeach;?>
                  
                </table>
            </td>
            <?php $i++; endforeach;?>
          </tr>
        </table>
    </td>
  </tr>
</table>

