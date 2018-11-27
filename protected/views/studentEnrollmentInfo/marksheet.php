<style>
.marksheet
{
margin:0 auto;
padding:20px 0px;
width:978px;
height:100%;
background:url(../images/chhayanaut_watermark.png) no-repeat center center;
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
border:1px solid #333;	
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
          <tr><td height="50">&nbsp;</td></tr>
          <tr>
            <td>
            	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet">
                	<tr>
                    	<td class="mfont1 tbl_nobdr"><strong>শিক্ষার্থী: <?php echo $model->student->student_name;?></strong></td>
                        <td class="mfont1 tbl_nobdr"><strong>প্রথম বর্ষ, রবীন্দ্রসঙ্গীত</strong></td>
                        <td class="mfont1 tbl_nobdr"><strong>পরিচিতি: ০০০০০০০০</strong></td>
                        <td colspan="2" class="mfont1 tbl_nobdr"><strong>ক্রমিক: ০০৭</strong></td>
                    </tr>
                    <tr>		 			 			  				
                    	<td align="center"><strong>পাঠ: ১০১</strong></td>
                        <td align="center"><strong>পাঠ: ১০২</strong></td>
                        <td align="center"><strong>পাঠ: ১০৩</strong></td>
                        <td colspan="2" align="center"><strong>পাঠ: ১১১</strong></td>
                    </tr>
                    <tr>		 			 			  				
                    	<td align="center"><strong>শুদ্ধসঙ্গীত</strong></td>
                        <td align="center"><strong>বাংলা গানের ধারা (তত্ত্ব)</strong></td>
                        <td align="center"><strong>ঐতিহ্য ও সংস্কৃতি (তত্ত্ব)</strong></td>
                        <td colspan="2" align="center"><strong>প্রকৃতি ও ঋতু ভাবনার গান</strong></td>
                    </tr>										
                    <tr>
                    	<td class="tbl_nopadding">
                        	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                            	<tr>		
                                	<td>পূর্ণ নম্বর</td>
                                    <td>পাশ নম্বর</td>
                                    <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                                </tr>
                                <tr>
                                	<td>১০০</td>
                                    <td>৪০</td>
                                    <td class="tbl_nobdr2">০৪</td>
                                </tr>
                            </table>
                        </td>
                        <td class="tbl_nopadding">
                        	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                            	<tr>		
                                	<td>পূর্ণ নম্বর</td>
                                    <td>পাশ নম্বর</td>
                                    <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                                </tr>
                                <tr>
                                	<td>১০০</td>
                                    <td>১২</td>
                                    <td class="tbl_nobdr2">০৪</td>
                                </tr>
                            </table>
                        </td>
                        <td class="tbl_nopadding">
                        	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                            	<tr>		
                                	<td>পূর্ণ নম্বর</td>
                                    <td>পাশ নম্বর</td>
                                    <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                                </tr>
                                <tr>
                                	<td>১০০</td>
                                    <td>৪০</td>
                                    <td class="tbl_nobdr2">১৫</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2" class="tbl_nopadding"><table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                          <tr>
                            <td>পূর্ণ নম্বর</td>
                            <td>পাশ নম্বর</td>
                            <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                          </tr>
                          <tr>
                            <td>১০০</td>
                            <td>৪০</td>
                            <td class="tbl_nobdr2">১০০</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                    	<td class="mfont1 tbl_nobdr3">&nbsp;</td>
                        <td class="mfont1 tbl_nobdr3">&nbsp;</td>
                        <td class="mfont1 tbl_nobdr3">&nbsp;</td>
                        <td class="mfont1 tbl_nobdr3">&nbsp;</td>
                        <td class="mfont1 tbl_nobdr3">&nbsp;</td>
                    </tr>	
                    <tr>		 			 			  				
                    	<td align="center"><strong>পাঠ: ১১২</strong></td>
                        <td align="center"><strong>পাঠ: ১১৩</strong></td>
                        <td rowspan="2" align="center"><strong>মোট</strong></td>
                        <td rowspan="2" align="center"><strong>অর্জিত মান</strong></td>
                        <td rowspan="2" align="center"><strong>দ্বিতীয় মান</strong></td>
                    </tr>
                    <tr>		 			 			  				
                    	<td align="center"><strong>রবীন্দ্রসৃষ্ট তালের গান</strong></td>
                        <td align="center"><strong>গীতিনাট্য</strong></td>
                    </tr>										
                    <tr>
                    	<td class="tbl_nopadding">
                        	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                            	<tr>		
                                	<td>পূর্ণ নম্বর</td>
                                    <td>পাশ নম্বর</td>
                                    <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                                </tr>
                                <tr>
                                	<td>১০০</td>
                                    <td>৪০</td>
                                    <td class="tbl_nobdr2">০৪</td>
                                </tr>
                            </table>
                        </td>
                        <td class="tbl_nopadding">
                        	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                            	<tr>		
                                	<td>পূর্ণ নম্বর</td>
                                    <td>পাশ নম্বর</td>
                                    <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                                </tr>
                                <tr>
                                	<td>১০০</td>
                                    <td>১২</td>
                                    <td class="tbl_nobdr2">০৪</td>
                                </tr>
                            </table>
                        </td>
                        <td class="tbl_nopadding">
                        	<table width="100%" cellspacing="0" cellpadding="5" class="tbl_marksheet2">
                            	<tr>		
                                	<td>পূর্ণ নম্বর</td>
                                    <td>পাশ নম্বর</td>
                                    <td class="tbl_nobdr2">অর্জিত নম্বর</td>
                                </tr>
                                <tr>
                                	<td>৫৫০</td>
                                    <td>২২০</td>
                                    <td class="tbl_nobdr2">১৩১</td>
                                </tr>
                            </table>
                        </td>
                        <td class="tbl_nopadding2" align="center">অর্জিত স্থান</td>
                        <td class="tbl_nopadding2" align="center">ওয়াইস বিনতে শেয়ার</td>
                    </tr>	
            	</table>
            </td>
          </tr>
          <tr><td height="120">&nbsp;</td></tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="40%">প্রকাশের তারিখ: ২৯ চৈত্র ১৪১৯</td>
                        <td width="25%" class="tbl_bdr">পাঠ সমন্বয়ক</td>
                        <td width="10%">&nbsp;</td>
                        <td width="25%" class=" tbl_bdr">অধ্যক্ষ</td>
                    </tr>
                </table>
            </td>
          </tr>
        </table>
    </div>	
	<!--Marksheet Ends-->