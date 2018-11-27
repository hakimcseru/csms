<style>


body
{
margin:0;
padding:0;
font-family:SolaimanLipi, Arial, Helvetica, sans-serif;
font-size:13px; 	
color:#333;
}

@media all {
	.page-break	{ display: none; }
}

@media print {
	table {margin:0;}
	
	header,footer {
   display:none;
}
}

@page { size:8.5in 5.5in; margin:0; }
header,footer {
   display:none;
}
/*Transfer Starts*/
.transfer
{
margin:0 auto;
/*margin-top:15px;*/
padding:0px 0px;
width:500px;
height:100%;
background-color:#fff;
color:#333;
overflow:hidden;	
}
.transfer h1
{
margin:0;
padding:0;
font-size:24px;
font-weight:normal;	
text-align:center;
}
.transfer h2
{
margin:0;
padding:0;
font-size:18px;
font-weight:normal;
text-align:center;	
}
.tbl_transfer
{
margin:0;
padding:0;
border-collapse:collapse;
border-spacing:0;
}
.tbl_transfer tr th
{
margin:0;
padding:0;
font-weight:bold;	
border:1px solid #333;	
}
.tbl_transfer tr td
{
width:auto;
height:50px;	
border:1px solid #333;	
}
.tfont1
{
font-size:16px;	
}
.tbl_bdr
{
text-align:center;	
border-top:1px solid #333;	
}
.spn_bdr
{
width:89px;	
border:1px solid #333;
border-left:none !important;
border-top:none !important;	
text-align:center;
}
.spn_bdr tr td
{
border:0 !important;	
height:30px !important;
}
/*Transfer Ends*/
</style>

<?php
foreach($stids as $stid):
		//echo $stid;
	$st=StudentEnrollmentInfo::model()->findByPk($stid);
	
	
if($st)
{
//$department_id=$st->department_id;
$student_pk=$st->student_pk;
$department_id=$st->department_id;
$course_id=$st->course_id;
$semister=$st->semester;
//echo "course_subject_ref_course_pk=".$course_id." and course_subject_semester_no=".$semister." and course_subject_department_id=".$department_id;
//$subjects=CourseSubject::model()->findAll("course_subject_ref_course_pk=".$course_id." and course_subject_semester_no=".$semister." and course_subject_department_id=".$department_id);	

//echo count($subjects);
?>

<div class="transfer">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1>ছাড়পত্র</h1></td>
          </tr>
          <tr>
            <td><h2>ছায়ানট সঙ্গীতবিদ্যায়তন</h2></td>
          </tr>
          <tr>
            <td><h2>বার্ষিক পরীক্ষা <?php echo Bndate::t($st->session);?></h2></td>
          </tr>
          <tr><td height="20">&nbsp;</td></tr>
          <tr>
            <td align="center" style="font-size:13px !important;">
            	কার্যক্রম: <?php echo Bndate::t($st->course->course_name);?>, বিভাগ: <?php echo Bndate::t($st->department->department_name);?>,  শ্রেণি: <?php echo Bndate::t(CourseSemesterLebel::model()->semesterLebel($st->course_id,$st->semester));?>, <br />
				নাম: <?php echo Bndate::t($st->student->student_name);?>, পরিচিতি: <?php echo Bndate::t($st->student->student_id);?>,  ক্রম: <?php echo Bndate::t($st->roll_no);?>
            </td>
          </tr>
          <tr><td height="20">&nbsp;</td></tr>
          <tr>
          	<td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl_transfer">
                	<tr>
                    	<th width="18%" class="tfont1">বিষয়</th>
                        <th width="58%" class="tfont1">মন্তব্য</th>
                        <th width="24%" class="tfont1">পরীক্ষক</th>
                    </tr>
					<?php foreach($subjects as $sub): 
					
					$subject=CourseSubject::model()->findByPk($sub);	
					?>
                    <tr>
                    	<td colspan="2" valign="top" style="height:75px;">
                        	<table width="auto" border="0" cellspacing="0" cellpadding="0" class="spn_bdr">
                            	<tr>
                                	<td><?php echo Bndate::t($subject->subject->subject_name);?></td>
                                </tr>
                            </table>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
					
					<?php endforeach;?>
                    
                </table>
            </td>	
          </tr>
          <tr><td height="75">&nbsp;</td></tr>
          <tr>
          <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="30%">&nbsp;</td>
                        <td width="40%" class=" tbl_bdr">স্বাক্ষর</td>
                        <td width="30%">&nbsp;</td>
                    </tr>
                </table>
            </td>
          </tr>
        </table>
    </div>



<?php

}
		
endforeach;
?>
