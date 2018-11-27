<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	</head>
	<body >
		<div class="container">
			
			<div class="row-fluid">
				
				<div class="offset3">
                                    <div class="span8 well" style="text-align: center">
						<?php echo $content; ?>
					</div>
				</div>
			</div>
		</div>
            <style>
                
                #footer{
                   margin: 0 auto;
    padding-left: 27px;
    width: 450px !important;
                }
            </style>
		<?php echo $this->renderPartial('//layouts/_footer'); ?>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/shortcut.js"></script>
		<?php //$this->widget('application.widgets.timepicker.registerScript', array()); ?>
                
                <script type="text/javascript">
    $("#StudentAttendanceData_student_reg_no").focus();
</script>
	</body>
</html>