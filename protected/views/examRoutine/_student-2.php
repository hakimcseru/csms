

<style>
	body{
	/*margin:50px;*/
    padding:0;	
    font-family:SolaimanLipi; 
    }
 	h4{margin:0; padding:0; font-size:15px; text-align:center; color:#333}
	.routine_tbl{border-collapse:collapse; border-spacing:0; color:#333; font-size:22px}
	.routine_tbl tr th{padding:8px; background-color:#fafafa; text-align:center; font-weight:bold; border:1px solid #333; vertical-align:middle}
	.routine_tbl tr td{padding:8px; text-align:center; border:1px solid #333; }
	.routine_tbl tr td div{line-height:22px}
		body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
   /* font: 12pt "Tahoma";*/
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
    width: 21cm;
    min-height: 29.7cm;
    padding: 0 .5cm;
    margin: 1cm auto;
    border: 1px #D3D3D3 solid;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}


@page {
    size: A4;
    margin: 0;
}
@media print {
    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}
</style>

<?php $i=1;
foreach($section as $sec):
if($i%3==1)
{
?>
<div class="page" >
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><h1 style="text-align:center;margin-bottom:0 !important;"><?php echo $course_name.", ".$department_name;?></h1></td>
  </tr>
  <tr>
    <!--td><h2 style="text-align:center;margin-bottom:0 !important;"><?php echo $batch_group_name;?>বার</h2></td>!-->
  </tr>
  <tr>
    <td><h2 style="text-align:center; margin-bottom:0 !important;">শ্রেণি: <?php echo $semester_name;?></h2></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  </table>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="routine_tbl">
          
            
			<?php } ?>
			<tr>
			<th><?php 
			$bss=BexamRoutineGroup::model()->findByPk($sec['batch_section_id']);
			echo "দল: ".Bndate::t($bss->batch->group_name);
			echo "</br>";
			echo "ক্রম: ".Bndate::t($bss->start_role."-".$bss->end_role);?></th>
            <?php 
			$criteria=new CDbCriteria;
			
			$criteria->with = array('exam_date');

			$criteria->order = 'exam_date.exam_date ASC';
			
			$criteria->condition= $where2." and t.batch_section_id=".$sec['batch_section_id'];
			
			
			//$events = Calendar::model()->findAll($criteria);
			$cp=ExamRoutineDetail::model()->findAll($criteria);
			
			foreach($cp as $riou):?>
			<td>
			<?php echo Bndate::BanglaNumDate(date("d F Y",strtotime($riou->exam_date->exam_date)));?>
			<br/>
			<?php echo Bndate::BanglaWeekDay(date("l",strtotime($riou->exam_date->exam_date)));?>
			</br>
			<?php echo Bndate::t($riou->exam_time);?>
			<br/>
			<?php echo Bndate::t($riou->subject->subject_name);?>
			<br/>
			<?php echo Bndate::t($riou->room->room_no);?>
			</td>
			
			
            <?php endforeach;?>
          </tr>
		  <?php      
 if($i%3==0)
{ echo '</table></div>';}
?>  

  <?php $i++; endforeach;?>
          
  <?php 
if(($i-1)%3!=0) { echo '</table></div>';}
?>
