<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vertical ID Card</title>

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles_card_horaizontal.css" />
		
		

	</head>
	<body>
	

<?php 
$counter=1;
foreach($model as $mod):
$detail=$mod->student;
?>
<div class="vertical_card_wrapper">
        <div class="card-header">
            <div class="card-left"><img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/card_logo.jpg" width="43" height="56" alt="" title="" /></div>
            <div class="card-right">
                <h1>ছায়ানট সঙ্গীতবিদ্যায়তন</h1>
                <h2><?php echo $mod->course->course_name;?></h2>
            </div>
            <div class="card-last">
                <div class="signe_wrapper">
                    <div class="left">
                <ul>
                    <li>
                        <label>শিক্ষার্থী</label>
                        <span><?php echo Bndate::t($mod->session);?></span>
                    </li>
                </ul>
            </div>
                </div>
            </div>
        </div>
        <div class="pic_wrapper">
            <img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/student/<?php echo $detail->student_image;?>" width="70"  />
        </div>
        <div class="info_wrapper">
            <ul>
                <li class="namefont"><?php echo $detail->student_name;?></li>
                <li>
                    <label><strong>পরিচিতি</strong></label>
                    <span>:</span>
                    <strong><?php echo Bndate::t($detail->student_id);?></strong>
                </li>
                <li>
                    <label>বিভাগ</label>
                    <span>:</span>
                    <?php echo $mod->department->department_name;?> 
                </li>
                <li>
                    <label>আবর্তন</label>
                    <span>:</span>
                  <?php echo $mod->batch->batch_id;?>
                </li>
                <li>
                    <label>দল</label>
                    <span>:</span>
                    <?php echo $mod->batchgroup->group_name;?>
                </li>
                <li>
                    <label>ক্রম</label>
                    <span>:</span>
                  <?php echo Bndate::t($mod->roll_no);?>
                </li>
            </ul>
			</div>
			<div style="clear:both;"></div>
			<div class="address_wrapper">ছায়ানট সংস্কৃতি-ভবন, বাড়ি ৭২, সড়ক ১৫এ, ধানমণ্ডি আ/এ, ঢাকা-১২০৯</div>
			<div class="tsign_wrapper">
				<div class="right">
					<ul>
						<li><img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/card-sign.jpg" width="78" height="26" alt="" title="" /></li>
						<li>অধ্যক্ষ</li>
					</ul>
				</div>
			</div>
			<div class="barcode"><img src="<?php echo Yii::app()->request->baseUrl; ?>/code/barcode.php?text=<?php echo "C".$detail->student_id;?> "   /></div>
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