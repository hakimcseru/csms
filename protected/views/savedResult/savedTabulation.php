	
<style>

.ured{color:red;-moz-text-decoration-color: red; text-decoration-color: red;}
body {margin:0; padding:0; font-family: SolaimanLipi,Arial,Helvetica,sans-serif; font-size: 15px !important;
	  color: #525252
	  }
.result_sheet{margin:15px; padding:0}
.result_sheet table{margin:0; background-color:#cecece}	  
.result_sheet table tr th{padding:6px 5px; font-weight:bold; background-color:#fafafa; color:#333; text-align:left}
.result_sheet table tr td{padding:0px 5px; font-weight:normal; background-color:#fff; text-align:left}
.result_sheet h1{margin:5px 0 0 0; padding:0; color:#333; font-size:20px; font-weight:bold; text-align:center}
.result_sheet h2{margin:0 0 5px 0; padding:0; color:#333; font-size:18px; font-weight:bold; text-align:center}
.result_sheet span{float:left}
.result_sheet span.txt_left{width:50%; text-align:left}
.result_sheet span.txt_right{width:50%; text-align:right}
.result_sheet input[type=text]{margin:3px 0 6px 0; padding:3px; font-size:15px; color:#525252; border:1px solid #ebebeb;
							   width:50px; height:15px;		
								}
								


.result_sheet2{margin:15px; padding:0}
.result_sheet2 table{margin:0; background-color:#cecece}	  
.result_sheet2 table tr th{padding:6px 5px; font-weight:bold; background-color:#fafafa; color:#333; text-align:left; border: 1px solid #EBEBEB;}
.result_sheet2 table tr td{padding:3px 5px; font-weight:normal; background-color:#fff; text-align:left;border: 1px solid #EBEBEB;}
.result_sheet2 h1{margin:5px 0 0 0; padding:0; color:#333; font-size:20px; font-weight:bold; text-align:center}
.result_sheet2 h2{margin:0 0 5px 0; padding:0; color:#333; font-size:18px; font-weight:bold; text-align:center}
</style>


<div class="result_sheet2">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td colspan="12">
            	<h1>বার্ষিক পরীক্ষা - <?php echo Bndate::t($session_id);?></h1>
            	<h2>কার্যক্রম: <?php echo $course;?>
				
				, বিভাগ: <?php echo $department;?>
				
				
				, শ্রেণি: <?php echo $semester;?>
				
				
				, দল: <?php echo $batch_group;?>
				
				
				</h2>
            </td>
          </tr>
		  
		  
		  
          <tr>
            <th>ক্রম</th>
            <th>নাম</th>
            <th>পরিচিতি</th>
			<?php //foreach($subjects as $sub):
			
			foreach($model2->resultsubject as $sub): 
					
					
			?>
            <th>পাঠ: <?php echo $sub->subject_code;?></th>
            
			<?php endforeach;?>
            <th>মোট</th>
            <th>মান</th>
			<th>স্থান</th>
            
          </tr>
		  
		  
          <tr>
            <th colspan="3">&nbsp;</th>
			<?php 
			$tm=0;
			foreach($model2->resultsubject as $sub): 
			
			
			
			?>
            <th><?php echo $sub->subject_name;?>
			<?php 
			$tm=$tm+$sub->subject_full_mark;
			echo Bndate::t(($sub->subject_full_mark));?>
			</th>
			<?php endforeach;?>
            
            <th><?php 
			
			 	
			echo Bndate::t(($tm));?>
			
			</th>
            <th colspan="2">&nbsp;</th>
          </tr>
		  
		  <?php 
		  
		  foreach($model as $data):
		  
		  ?>
          <tr>
            <td><?php echo Bndate::t($data->roll_no);?></td>
			
            <td><?php echo $data->name;?>
			</td>
            <td><?php echo Bndate::t($data->student_id);?></td>
			
            <?php 
			//echo count($data->resultsubject);
			foreach($data->resultsubject as $ssub):
			echo '<td>'.Bndate::t(($ssub->student_subject_marks)).'</td>';
			endforeach;?>
			
            <td>
			<?php echo Bndate::t(($data->total_number));?>
			
			</td>
            <td>
			<?php echo $data->result;?>
			</td>
           <td>
		   <?php echo $data->position;?>
		   </td>
         
		  
          
          </tr>
        
		<?php endforeach;?>
		
		</table>
    </div>  
	
