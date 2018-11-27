<style>
body{
margin:0;
padding:0;
font-family:Arial, Helvetica, sans-serif, SolaimanLipi;
font-size:14px;	
color:#525252;
/*background:url(/csms/images/chhayanaut_watermark.png) no-repeat top left;*/
}
.marksheet
{
margin:0 auto;
padding:0px 0px;
width:978px;
height:auto;
background:url(/csms/images/chhayanaut_watermark.png) no-repeat top left;
background-color:#fff;
color:#333;
overflow:hidden;	
}
.marksheet h1
{
margin:0;
padding:0;
font-size:24px;
font-weight:normal;	
text-align:center;
}
.marksheet h2
{
margin:0;
padding:0;
font-size:18px;
font-weight:normal;
text-align:center;	
}
.mfont1
{
font-size:16px;	
}
.tbl_marksheet
{
margin:0;
padding:0;
border-collapse:collapse;
border-spacing:0;
}
.tbl_marksheet tr td
{
/*border:1px solid #333;*/
border:0 !important;
}
.tbl_nobdr
{
padding:20px 0px;	
border-top:1px solid transparent !important;
border-right:1px solid transparent !important;
border-left:1px solid transparent !important;
border-bottom:1px solid #333 !important;
}
.tbl_nobdr2
{
border-right:0 !important;	
}
.tbl_nobdr3
{
padding:10px 0px;	
border-top:1px solid transparent !important;
border-right:1px solid transparent !important;
border-left:1px solid transparent !important;
border-bottom:1px solid #333 !important;
}
.tbl_bdr
{
text-align:center;	
border-top:1px solid #333;	
}
.tbl_nopadding
{
padding:0 !important;	
}
.tbl_nopadding2
{
padding:0 !important;
border-top:2px solid #333 !important;	
}
.tbl_marksheet2
{
margin:0;
padding:0;
border-collapse:collapse;
border-spacing:0;
}
.tbl_marksheet2 tr td
{
border:1px solid #333;
border-left:0;
border-bottom:0;	
}
/*Marksheet Ends*/

.tbl_div{margin-bottom:40px; width:243px; height:auto; float:left; overflow:hidden}
.formatting{margin:0; padding:0; border-collapse:collapse; border-spacing:0}
.formatting tr td{padding:5px; border: 1px solid #333333}
.off_padding{padding:0 !important}
.off_bdr{border-right:0 !important}
.off_bdr2{border-bottom:0 !important; border-left:0 !important}
.off_bdr3{border-bottom:0 !important}
.off_bdr4{border-top:0 !important}
.merge_height{height:85px}
.merge_height2{height:85px}
.merge_height3{height:63px}
</style>
<div class="marksheet">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1>ছায়ানট সঙ্গীতবিদ্যায়তন</h1></td>
          </tr>
          <tr>
            <td><h2>নম্বরপত্র, <?php echo $model->course->course_name;?></h2></td>
          </tr>
          <tr>
            <td><h2>শিক্ষাবর্ষ: <?php echo Bndate::t($model->session);?></h2></td>
          </tr>
          
          <tr><td height="15">&nbsp;</td></tr>
          
          <tr>
            <td>
            	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet">
                	<tr>
                    	<td width="25%" class="mfont1 tbl_nobdr"><strong>শিক্ষার্থী: <?php echo $model->student->student_name;?></strong></td>
                        <td width="25%" class="mfont1 tbl_nobdr"><strong><?php echo CourseSemesterLebel::model()->semesterLebel($model->course_id,$model->semester,0);?>, <?php echo $model->department->department_name;?></strong></td>
                        <td width="25%" class="mfont1 tbl_nobdr"><strong>পরিচিতি: <?php echo Bndate::t($model->student_id);?></strong></td>
                        <td width="25%" colspan="2" class="mfont1 tbl_nobdr"><strong>ক্রমিক: <?php echo Bndate::t($model->roll_no);?></strong></td>
                    </tr>
            	</table>
            </td>
          </tr>
          
          
          <tr>
          	<td>
			
			<?php $tfm=0;$tpm=0;$ttsm=0;
			
					$subjectse=Examsetting::model()->findAll("session='".$model->session."' and course='".$model->course_id."' and department='".$model->department_id."' and batch_id='".$model->batch_id."' and batch_group='".$model->batch_group."' and semester='".$model->semester."'");
					
					//$subjects=CourseSubject::model()->findAll("course_subject_ref_course_pk=".$model->course_id." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$model->department_id." order by course_subject_semester_no asc ");	
					
					//echo count($subjects);
					?>
                    
					<?php 
					$fail=0;
					$i=1;
					//subjectse
					foreach($subjectse as $sub2): 
					
					$sub=CourseSubject::model()->find("course_subject_ref_course_pk=".$model->course_id." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$model->department_id." and course_subject_ref_subject_pk='".$sub2->subject."' ");
					
					//$sub=$sub2->subjects;
					
					
					?>
			
            	<div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                    	<tr>
                        	<td align="center">পাঠ: <?php echo $sub->subject->subject_code;?></td>  
                        </tr>
                        <tr>
                        	<td align="center" style="height:53px; overflow:hidden;" ><?php echo $sub->subject->subject_name;?></td>
                        </tr>
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td class="off_bdr2 off_bdr4">পূর্ণ নম্বর</td>
                                        <td class="off_bdr off_bdr2 off_bdr4">পাশ নম্বর</td>
                                        <td class="off_bdr off_bdr3 off_bdr4">অর্জিত নম্বর</td>
                                    </tr>
                                    <tr>
                                    	<td class="off_bdr2"><?php 
										
										$tfm=$tfm+$sub->full_mark;echo Bndate::t($sub->full_mark);?></td>
                                        <td class="off_bdr off_bdr2"><?php $tpm=$tpm+$sub->pass_mark; echo Bndate::t($sub->pass_mark);?></td>
                                        <td class="off_bdr off_bdr3">
										<?php $st_res=StudentResult::model()->find("session='".$model->session."' and course='".$model->course_id."' and department='".$model->department_id."' and  subject='".$sub->course_subject_ref_subject_pk."' and student_pk='".$model->student_pk."' and student_id='".$model->student_id."'");
									
									if(isset($st_res->examsetting))
									{
									if($st_res->result=='অ')
									{
									echo $st_res->result;
									}
									else
									{
									if($st_res->examsetting->mark_type=="Grading")
									{
									echo $st_res->full_marks;
									}
									else{
									if($st_res) $sm=$st_res->full_marks; else $sm=0;
									
									if($sm<$sub->pass_mark)
									$fail=1;
									
									$ttsm=$ttsm+$sm;
									echo Bndate::t($sm);
									}}}
									?>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php endforeach;?>
                
                
                
                
                
                
                
                
              <?php 
			  if(isset($st_res->examsetting))
									{
									if($st_res->examsetting->mark_type=="Grading")
									{
									//echo $st_res->full_marks;
									}
									else{
									?>
                
                <div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                    	<tr>
                        	<td align="center" class="merge_height">মোট</td>
                        </tr>
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td class="off_bdr2 off_bdr4">পূর্ণ নম্বর</td>
                                        <td class="off_bdr off_bdr2 off_bdr4">পাশ নম্বর</td>
                                        <td class="off_bdr off_bdr3 off_bdr4">অর্জিত নম্বর</td>
                                    </tr>
                                    <tr>
                                    	<td class="off_bdr2"><?php echo Bndate::t($tfm);?></td>
                                        <td class="off_bdr off_bdr2"><?php echo Bndate::t($tpm);?></td>
                                        <td class="off_bdr off_bdr3"><?php echo Bndate::t($ttsm);?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td align="center" class="off_bdr2 off_bdr4 merge_height2">অর্জিত মান</td>
                                        <td align="center" class="off_bdr off_bdr2 off_bdr4 merge_height2">
										<?php
										if(isset($st_res->examsetting))
										{
										if($st_res->examsetting->mark_type=="Grading")
										{
										echo "";
										}
										else{
										if($fail==0)
										{
										
										
										$per=($ttsm/$tfm)*100;
										$per=number_format($per, 2, '.', '');
										
										$res=ResultSetings::model()->find("session='".$model->session."' and	'".$per."'>=start_limit and '".$per."'<=end_limit");
										if($res) echo $res->result; else echo "NA";
										}
										elseif($fail==1)
										{
										
										$per=($ttsm/$tfm)*100;
										$per=number_format($per, 2, '.', '');
										
										
										
										if($per>=50) echo "বিশেষ বিবেচনায় উত্তীর্ণ";
										else echo "অকৃতকার্য";
										
										}
										
										}}
										?>
										</td>
                                    </tr>
                                    <tr>
                                    	<td align="center" class="off_bdr2 merge_height3">অর্জিত স্থান</td>
                                        <td align="center" class="off_bdr off_bdr2 merge_height3">
										<?php
										if($fail==0)
										{
		   $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT distinct(student_pk) FROM student_result where

		session='".$model->session."' and
		course='".$model->course_id."' and
		department='".$model->department_id."' and
		semester='".$model->semester."' and
		batch_id='".$model->batch_id."' and
		batch_group='".$model->batch_group."'
		
		
		
		group by student_pk having sum(full_marks) > $ttsm
		");
		$hm = $command->queryAll();
		echo Bndate::t(count($hm)+1);
		}
		?>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php }}?>
            </td>
          </tr>
          
          
          
          
          <tr>
          	<td height="40" align="right" valign="middle">
            	<img style="margin-right:50px;" src="/csms/images/sign.jpg" width="140" height="36" alt="" title="" />
            </td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="40%">প্রকাশের তারিখ:  ২৭চৈত্র ১৪২০</td>
                        <td width="25%" class="tbl_bdr">পাঠ সমন্বয়ক</td>
                        <td width="10%">&nbsp;</td>
                        <td width="25%" class=" tbl_bdr">অধ্যক্ষ</td>
                    </tr>
                </table>
            </td>
          </tr>
        </table>
    </div>	



<div class="marksheet">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1>ছায়ানট সঙ্গীতবিদ্যায়তন</h1></td>
          </tr>
          <tr>
            <td><h2>নম্বরপত্র, <?php echo $model->course->course_name;?></h2></td>
          </tr>
          <tr>
            <td><h2>শিক্ষাবর্ষ: <?php echo Bndate::t($model->session);?></h2></td>
          </tr>
          
          <tr><td height="15">&nbsp;</td></tr>
          
          <tr>
            <td>
            	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet">
                	<tr>
                    	<td width="25%" class="mfont1 tbl_nobdr"><strong>শিক্ষার্থী: <?php echo $model->student->student_name;?></strong></td>
                        <td width="25%" class="mfont1 tbl_nobdr"><strong><?php echo CourseSemesterLebel::model()->semesterLebel($model->course_id,$model->semester,0);?>, <?php echo $model->department->department_name;?></strong></td>
                        <td width="25%" class="mfont1 tbl_nobdr"><strong>পরিচিতি: <?php echo Bndate::t($model->student_id);?></strong></td>
                        <td width="25%" colspan="2" class="mfont1 tbl_nobdr"><strong>ক্রমিক: <?php echo Bndate::t($model->roll_no);?></strong></td>
                    </tr>
            	</table>
            </td>
          </tr>
          
          
          <tr>
          	<td>
			
			<?php $tfm=0;$tpm=0;$ttsm=0;
					$subjects=CourseSubject::model()->findAll("course_subject_ref_course_pk=".$model->course_id." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$model->department_id." order by course_subject_semester_no asc ");	
					
					//echo count($subjects);
					?>
                    
					<?php 
					$fail=0;
					$i=1;foreach($subjects as $sub): ?>
			
            	<div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                    	<tr>
                        	<td align="center">পাঠ: <?php echo $sub->subject->subject_code;?></td>
                        </tr>
                        <tr>
                        	<td align="center" style="height:53px; overflow:hidden;" ><?php echo $sub->subject->subject_name;?></td>
                        </tr>
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td class="off_bdr2 off_bdr4">পূর্ণ নম্বর</td>
                                        <td class="off_bdr off_bdr2 off_bdr4">পাশ নম্বর</td>
                                        <td class="off_bdr off_bdr3 off_bdr4">অর্জিত নম্বর</td>
                                    </tr>
                                    <tr>
                                    	<td class="off_bdr2"><?php 
										
										$tfm=$tfm+$sub->full_mark;echo Bndate::t($sub->full_mark);?></td>
                                        <td class="off_bdr off_bdr2"><?php $tpm=$tpm+$sub->pass_mark; echo Bndate::t($sub->pass_mark);?></td>
                                        <td class="off_bdr off_bdr3">
										<?php $st_res=StudentResult::model()->find("session='".$model->session."' and course='".$model->course_id."' and department='".$model->department_id."' and  subject='".$sub->course_subject_ref_subject_pk."' and student_pk='".$model->student_pk."' and student_id='".$model->student_id."'");
									
									if(isset($st_res->examsetting))
									{
									if($st_res->examsetting->mark_type=="Grading")
									{
									echo $st_res->full_marks;
									}
									else{
									if($st_res) $sm=$st_res->full_marks; else $sm=0;
									
									if($sm<$sub->pass_mark)
									$fail=1;
									
									$ttsm=$ttsm+$sm;
									echo Bndate::t($sm);
									}}
									?>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php endforeach;?>
                
                
                
                
                
                
                
                
              <?php 
			  if(isset($st_res->examsetting))
									{
									if($st_res->examsetting->mark_type=="Grading")
									{
									//echo $st_res->full_marks;
									}
									else{
									?>
                
                <div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                    	<tr>
                        	<td align="center" class="merge_height">মোট</td>
                        </tr>
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td class="off_bdr2 off_bdr4">পূর্ণ নম্বর</td>
                                        <td class="off_bdr off_bdr2 off_bdr4">পাশ নম্বর</td>
                                        <td class="off_bdr off_bdr3 off_bdr4">অর্জিত নম্বর</td>
                                    </tr>
                                    <tr>
                                    	<td class="off_bdr2"><?php echo Bndate::t($tfm);?></td>
                                        <td class="off_bdr off_bdr2"><?php echo Bndate::t($tpm);?></td>
                                        <td class="off_bdr off_bdr3"><?php echo Bndate::t($ttsm);?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td align="center" class="off_bdr2 off_bdr4 merge_height2">অর্জিত মান</td>
                                        <td align="center" class="off_bdr off_bdr2 off_bdr4 merge_height2">
										<?php
										if(isset($st_res->examsetting))
										{
										if($st_res->examsetting->mark_type=="Grading")
										{
										echo "";
										}
										else{
										if($fail==0)
										{
										
										
										$per=($ttsm/$tfm)*100;
										$per=number_format($per, 2, '.', '');
										
										$res=ResultSetings::model()->find("session='".$model->session."' and	'".$per."'>=start_limit and '".$per."'<=end_limit");
										if($res) echo $res->result; else echo "NA";
										}
										elseif($fail==1)
										{
										
										$per=($ttsm/$tfm)*100;
										$per=number_format($per, 2, '.', '');
										
										
										
										if($per>=50) echo "বিশেষ বিবেচনায় উত্তীর্ণ";
										else echo "অকৃতকার্য";
										
										}
										
										}}
										?>
										</td>
                                    </tr>
                                    <tr>
                                    	<td align="center" class="off_bdr2 merge_height3">অর্জিত স্থান</td>
                                        <td align="center" class="off_bdr off_bdr2 merge_height3">
										<?php
										if($fail==0)
										{
		   $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT distinct(student_pk) FROM student_result where

		session='".$model->session."' and
		course='".$model->course_id."' and
		department='".$model->department_id."' and
		semester='".$model->semester."' and
		batch_id='".$model->batch_id."' and
		batch_group='".$model->batch_group."'
		
		
		
		group by student_pk having sum(full_marks) > $ttsm
		");
		$hm = $command->queryAll();
		echo Bndate::t(count($hm)+1);
		}
		?>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php }}?>
            </td>
          </tr>
          
          
          
          
          <tr>
          	<td height="40" align="right" valign="middle">
            	<img style="margin-right:50px;" src="/csms/images/sign.jpg" width="140" height="36" alt="" title="" />
            </td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="40%">প্রকাশের তারিখ:  ২৭চৈত্র ১৪২০</td>
                        <td width="25%" class="tbl_bdr">পাঠ সমন্বয়ক</td>
                        <td width="10%">&nbsp;</td>
                        <td width="25%" class=" tbl_bdr">অধ্যক্ষ</td>
                    </tr>
                </table>
            </td>
          </tr>
        </table>
    </div>	

