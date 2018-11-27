<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vertical ID Card</title>

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles_card_vertical.css" />
		
		

	</head>
	<body>
	<style>
	
.vertical_card_wrapper .card-header .card-right {
   float:initial !important;
    margin: 0 auto !important;
    text-align: center !important ;
    width: 41px !important;
}
	</style>

<?php 

$counter=1;

foreach($model as $mod):
    //print_r($mod); die();
$detail=$mod->student;
?>

 <div class="vertical_card_wrapper">
        <div class="card-header">
            <div class="card-left"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/card_logo.jpg" width="43" height="56" alt="" title="" /></div>
            <div class="card-right">
                <h1>ছায়ানট</h1>
                <h2><?php echo $mod->course->course_name;?></h2>
            </div>
        </div>
        <div class="pic_wrapper"> 
		<img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/student/<?php echo $detail->student_image;?>" width="70"  />
            
        </div>
        <div class="info_wrapper">
            <ul>
                <li class="namefont" style="line-height:23px; text-align:center;">
                    <?php echo $detail->student_name;?>
                </li>
				<li style="line-height:25px;text-align:center;">
                    
                    
               <?php echo $mod->batch->batch_id;?>,
			   ক্রম : 
                    
                    <?php echo Bndate::t($mod->roll_no);?>
                </li>
               
               
                <li style="line-height:25px;text-align:center;">
                  পরিচিতি :  
                    <?php echo Bndate::t($detail->student_id);?>
                </li>
                
            </ul>
        </div>
        <div class="sign_wrapper">
            <div class="left">
                <ul>
                    <li>
                        <label>শিক্ষার্থী</label>
                        <span><?php echo Bndate::t($mod->session);?></span>
                    </li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/5.jpg" width="78" height="26" alt="" title="" /></li>
                    <li>সঞ্চালক</li>
                </ul>
            </div>
        </div>
        <div class="address_wrapper">ছায়ানট সংস্কৃতি-ভবন, বাড়ি ৭২, সড়ক ১৫এ, ধানমণ্ডি আ/এ, ঢাকা-১২০৯ </div>
        <div class="barcode"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/code/barcode.php?text=<?php echo "C".$detail->student_id;?> "   /></div>
    </div>
	
<?php
if($counter%8==0){ 
		echo '<hr style="page-break-after:always; visibility: hidden">';
		}
$counter++;
endforeach;
?>
</div>
</body>
</html>