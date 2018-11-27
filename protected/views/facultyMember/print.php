<style>
	
	
	@charset "utf-8";
/* CSS Document */



body
{
margin:0;
padding:0;
font-family:SolaimanLipi;
font-size:13px;
color:#333;	
}

.main-size /*A4 Paper Size*/
{
margin:0 auto;
/*width:595px !important;*/
width:912px !important;
/*height:648px !important;*/
/*border:1px solid #ccc;*/
overflow:hidden;
}

.namefont 
{
font-size: 14px;
font-weight: bold;
}

.vertical_card_wrapper
{
margin:5px 8px;
padding:5px 5px;
width:200px;
height:302px !important;
background:#fff;
border:1px solid #c0c0c0;
-moz-border-radius:8px;
-webkit-border-radius:8px;
-khtml-border-radius:8px;
border-radius:8px;	
overflow:hidden;
float:left;
}
.vertical_card_wrapper .card-header
{
margin:10px 0 0 0;
padding:0;
overflow:hidden;
}
.vertical_card_wrapper .card-header h1
{
margin:2px 0 0 0;
padding:0;	
font-size:15px;
font-weight:normal;	
}
.vertical_card_wrapper .card-header h2
{
margin:0;
padding:0;	
color:#72BF44;	
font-size:13px;
line-height:17px;
font-weight:normal;	
font-style:italic;
}
.vertical_card_wrapper .card-header .card-left
{
margin-left:3px;
margin-right:10px;	
float:left;	
}
.vertical_card_wrapper .card-header .card-right
{
float:left;	
}

.pic_wrapper
{
margin-top: -10px;	
width:200px;
height:auto;
margin:0 auto;
text-align:center;	
min-height:103px;
}
.pic_wrapper img
{
/*margin-left:56px;*/
min-height:100px;
border:2px solid #d9d9d9;	
}

.info_wrapper
{
margin-top:5px;	
width:200px;
height:48px;	
}
.info_wrapper ul
{
margin:8px 0 0 6px;
padding:0;
overflow:hidden;	
}
.info_wrapper ul li
{
margin:0;
padding:0;
list-style-type:none;
line-height:22px;
display:block;
clear:both;	
text-align:center;
font-size: 14px;
}
.info_wrapper ul li label
{
width:65px;
float:left;	
}
.info_wrapper ul li span
{
margin:0 5px 0 0;	
}

.sign_wrapper
{
width:200px;
height:auto;	
}
.sign_wrapper .left
{
float:left;	
}
.sign_wrapper .left ul
{
margin:0 0 0 0;
padding:0;
overflow:hidden;	
}
.sign_wrapper .left ul li
{
margin:0;
padding:0;
list-style-type:none;
display:block;
text-align:center;
}
.sign_wrapper .left ul li label
{
font-size:17px;
line-height:22px;
color:#F6863C;
display:block;		
clear:both;
}
.sign_wrapper .left ul li span
{
font-size:22px;
line-height:22px;
color:#F6863C;
display:block;		
clear:both;
margin-top:18px;
text-indent:10px;
}
.sign_wrapper .right
{
float:left;	
}
.sign_wrapper .right ul
{
margin:3px 0 0 60px;
padding:0;
overflow:hidden;	
}
.sign_wrapper .right ul li
{
margin:0;
padding:0;
list-style-type:none;
display:block;
clear:both;
font-size:13px;
line-height:12px;
text-align:center;
}

.address_wrapper
{
margin:8px 0 0 8px;
font-size:7px;
float:left;
clear:both;
}

.barcode
{
margin:0 auto;
text-align:center;
margin-top:62px;		
width:200px;
height:20px;
position:relative;
/*background:url(../images/barcode.jpg) no-repeat center center;*/
}

</style>





<?php 
$counter=1;

foreach($tids as $tid):

$mod=FacultyMember::model()->findByPk($tid);

?>

<div class="vertical_card_wrapper">
                    <div class="card-header">
                        <div class="card-left"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/card_logo.jpg" width="43" height="56" alt="" title="" /></div>
                        <div class="card-right">
                            <h1>ছায়ানট সঙ্গীতবিদ্যায়তন</h1>
                        </div>
                    </div>
                    <div class="pic_wrapper">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/faculty/<?php echo $mod->member_image;?>" width="" height="100" alt="" title="" />
                    </div>
                    <div class="info_wrapper">
                        <ul>
                            <li class="namefont">
                               <?php echo $mod->member_name;?>
                            </li>
                            <li>
                                <strong><?php echo $mod->designation;?></strong>
                            </li>
                        </ul>
                    </div>
                    <div class="sign_wrapper">
                        <div class="left">
                            <ul>
                                <li>
                                    <span><?php echo Bndate::t(Bndate::get_year(date("Y-m-d")));?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="right">
                            <ul>
                                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/card-sign.jpg" width="78" height="26" alt="" title="" /></li>
                                <li>অধ্যক্ষ</li>
                            </ul>
                        </div>
                    </div>
                    <div class="address_wrapper">ছায়ানট সংস্কৃতি-ভবন, বাড়ি ৭২, সড়ক ১৫এ, ধানমণ্ডি আ/এ, ঢাকা- ১২০৯ </div>
                    <div class="barcode">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/code/barcode.php?text=<?php echo "C".$mod->member_id;?> "   />
					</div>
                </div>
				
				<?php
if($counter%8==0){ 
		echo '<hr style="page-break-after:always; visibility: hidden">';
		}
$counter++;
endforeach;
?>
				
