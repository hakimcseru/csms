<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
		
		

	</head>
	<body>
		<div class="container-fluid">
			<?php $this->widget('bootstrap.widgets.BootNavbar', array(
					'fixed'=>'top',
					'brand'=>Yii::t('core', 'Chhayanaut'),
					'brandUrl'=>Yii::app()->baseUrl,
					'collapse'=>true, // requires bootstrap-responsive.css
					'items'=>array(
						array(
							'class'=>'bootstrap.widgets.BootMenu',
							'items'=>array(
								array('label'=>Yii::t('core', 'Home'), 'url'=>  Yii::app()->homeUrl),
								//array('label'=>Yii::t('core', 'Attendance'), 'url'=>  Yii::app()->createUrl('attendance/tempData/index')),
							),
						),
						'<form class="navbar-search pull-left" action="'.Yii::app()->createUrl('student/searchByRegNo').'" method="post"><input type="text" class="search-query span4" placeholder="Search" name="searchid"></form>',
						array(
							'class'=>'bootstrap.widgets.BootMenu',
							'htmlOptions'=>array('class'=>'pull-right'),
							'items'=>array(
								
									array('label'=>'Admin', 'url'=>'#', 'items'=>array(
											array('label'=> Yii::t('core', 'Login'), 'url'=> Yii::app()->createUrl('site/login'), 'visible'=>  Yii::app()->user->isGuest),
											array('label'=>Yii::t('core', 'Profile'), 'url'=>  Yii::app()->createUrl('user/profile'), 'visible'=>  !Yii::app()->user->isGuest),
											array('label'=>Yii::t('core', 'Update Profile'), 'url'=> Yii::app()->createUrl('user/profile/edit'), 'visible'=>  !Yii::app()->user->isGuest),
											array('label'=>Yii::t('core', 'Change Password'), 'url'=> Yii::app()->createUrl('authenticate/authUser/admin'), 'visible'=>  !Yii::app()->user->isGuest),
											array('label'=> Yii::t('core', 'Logout'), 'url'=> Yii::app()->createUrl('site/logout'), 'visible'=>  !Yii::app()->user->isGuest),
									)),
								array('label'=>Yii::t('core','Language'), 'url'=>'#', 'items'=>array(
									array('label'=>'English', 'url'=>  Yii::app()->createUrl(
											(isset($this->module)? $this->module->getName().'/' : '').$this->ID.'/'.$this->action->id, array('language'=>'en'))),
									array('label'=>'বাংলা', 'url'=> Yii::app()->createUrl(
											(isset($this->module)? $this->module->getName().'/' : '').$this->ID.'/'.$this->action->id, array('language'=>'bn'))),
								)),
							),
						),
					),
				)); ?>

			<div class="row-fluid">
				<?php echo $content ?>
			</div>
			<?php echo $this->renderPartial('//layouts/_footer'); ?>
		</div>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/shortcut.js"></script>
		<?php $this->widget('application.widgets.timepicker.registerScript', array()); ?>
	</body>
</html>
