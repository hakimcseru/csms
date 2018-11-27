<style>
/* added new */

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
	
	body{font-family:SolaimanLipi !important; font-size:16px;}

	.tdata .bdr1{border:1px solid #ccc}
	.tdata .bdr2{border:1px solid #ccc; border-left:none}
	.tdata .bdr3{border:1px solid #ccc; border-top:none}
	
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
    /*border: 1px #D3D3D3 solid;
    border-radius: 5px;*/
    background: white;
    /*box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);*/
}


@page {
    size: A4;
    margin: 0;
}
@media print {
    .page {
        margin: 0;
        /*border: initial;
        border-radius: initial;*/
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}


/* added new */


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
background:url(<?php echo Yii::app()->request->baseUrl;?>/images/chhayanaut_watermark.png) no-repeat top;
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

.tbl_div{margin-bottom:40px; width:243px;  height:150px; float:left; overflow:hidden;}
.formatting{margin:0; padding:0; border-collapse:collapse; border-spacing:0;height:100%;}
.formatting tr td{padding:5px; border: 1px solid #333333}
.off_padding{padding:0 !important}
.off_bdr{border-right:0 !important}
.off_bdr2{border-bottom:0 !important; border-left:0 !important}
.off_left_border{border-left:0 !important;}
.off_bdr3{border-bottom:0 !important}
.off_bdr4{border-top:0 !important}
.merge_height{height:85px}
.merge_height2{	height:85px}
.merge_height3{height:63px}
</style>
<?php foreach($models as $model):?>

<div class="marksheet page">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td><h1>ছায়ানট সঙ্গীতবিদ্যায়তন</h1></td>
          </tr>
          <tr>
            <td><h2>মূল্যায়নপত্র, <?php echo $model->course;?></h2></td>
          </tr>
          <tr>
            <td><h2>শিক্ষাবর্ষ: <?php echo Bndate::t($model->session_id);?></h2></td>
          </tr>
          
          <tr><td height="15">&nbsp;</td></tr>
          
          <tr>
            <td>
            	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet">
                	<tr>
                    	<td width="25%" class="mfont1 tbl_nobdr"><strong>শিক্ষার্থী: <?php echo $model->name;?></strong></td>
                        <td width="25%" class="mfont1 tbl_nobdr"><strong><?php echo $model->semester;?>, <?php echo $model->department;?></strong></td>
                        <td width="25%" class="mfont1 tbl_nobdr"><strong>পরিচিতি: <?php echo Bndate::t($model->student_id);?></strong></td>
                        <td width="25%" colspan="2" class="mfont1 tbl_nobdr"><strong>ক্রমিক: <?php echo Bndate::t($model->roll_no);?></strong></td>
                    </tr>
            	</table>
            </td>
          </tr>
          
          
          <tr>
          	<td align="center" valign="top" style="text-aligh:center !important; height:400px !important;">
			
			<?php 
			$subfull_mark=0;
					$subpass_mark=0;
					foreach($model->resultsubject as $sub): 
					
					
					
					?>
			
            	<div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                    	<tr>
                        	<td align="center">পাঠ: <?php echo $sub->subject_code;?></td>  
                        </tr>
                        <tr>
                        	<td align="center" style="height:53px; overflow:hidden;" ><?php echo $sub->subject_name;?></td>
                        </tr>
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<?php if(trim($model->result)){?>
										
										<td class="off_bdr2 off_bdr4">পূর্ণ নম্বর</td>
                                        <td class="off_bdr off_bdr2 off_bdr4 off_left_border">পাশ নম্বর</td>
                                        <td class="off_bdr off_bdr3 off_bdr4 off_left_border">অর্জিত নম্বর</td>
										<?php } else {?>
										<td class="off_bdr off_bdr3 off_bdr4 off_left_border" align="center">অর্জিত মান</td>
										<?php }?>
                                    </tr>
                                    <tr>
									<?php if(trim($model->result)){?>
									 
										
										<td class="off_bdr2"><?php 
										$subfull_mark=$subfull_mark+$sub->subject_full_mark;
										echo Bndate::t(($sub->subject_full_mark));?></td>
                                        <td class="off_bdr off_bdr2"><?php 
										$subpass_mark=$subpass_mark+$sub->subject_min_mark;
										echo Bndate::t($sub->subject_min_mark);?></td>
                                        <td class="off_bdr off_bdr3">
										<?php echo Bndate::t(($sub->student_subject_marks));?>
										</td>
									<?php } else {?>
                                    	<td class="off_bdr off_bdr3" align="center">
										<?php echo Bndate::t(($sub->student_subject_marks));?>
										</td>
										<?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
				<?php endforeach;?>
                
                
                
                
                
                
                
                
             
                <?php if(trim($model->result)){?>
                
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
                                        <!--<td class="off_bdr off_bdr2 off_bdr4">পাশ নম্বর</td>-->
                                        <td class="off_bdr off_bdr3 off_bdr4 off_left_border">অর্জিত নম্বর</td>
                                    </tr>
                                    <tr>
                                    	<td class="off_bdr2"><?php echo Bndate::t(($subfull_mark));?></td>
                                        <!--<td class="off_bdr off_bdr2"><?php //echo Bndate::t($subpass_mark);?></td>-->
                                        <td class="off_bdr off_bdr3"><?php echo Bndate::t(($model->total_number));?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div><?php }?>
				<!--
                <div class="tbl_div">
                	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting">
                        <tr>
                        	<td class="off_padding">
                            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="formatting2">
                                	<tr>
                                    	<td align="center" class="off_bdr2 off_bdr4 merge_height2">অর্জিত মান</td>
										<td align="center" class="off_bdr off_bdr2 off_bdr4 merge_height2">অর্জিত স্থান</td>
                                      
                                    </tr>
                                    <tr>
                                    	
										  <td align="center" class="off_bdr2 merge_height3">
										<?php //echo $model->result;?>
										</td>
                                        <td align="center" class="off_bdr off_bdr2 merge_height3">
										<?php //echo Bndate::t($model->position);?>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>-->
				
            </td>
          </tr>
          
          
          <tr><?php if(trim($model->result)){?><td align="left" style="font-weight:bold;">অর্জিত মান: <?php echo $model->result;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;অর্জিত স্থান: <?php echo Bndate::t($model->position);?><?php }?></td></tr>
          
          <tr>
          	<td height="40" align="right" valign="middle">
            	<img style="margin-right:50px;" src="/csms/images/sign.jpg" width="140" height="36" alt="" title="" />
            </td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="40%">প্রকাশের তারিখ: <?php echo Bndate::t($model->published_date, true);?></td>
                        <td width="25%" class="tbl_bdr">পাঠ সমন্বয়ক</td>
                        <td width="10%">&nbsp;</td>
                        <td width="25%" class=" tbl_bdr">অধ্যক্ষ</td>
                    </tr>
                </table>
            </td>
          </tr>
        </table>
    </div>	



<?php endforeach;?>
