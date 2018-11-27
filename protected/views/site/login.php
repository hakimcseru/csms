<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<style>
	.well 
	{
	padding: 50px 0px;	
    /*background-color: #fafafa;*/
	background-color:#f7f7f7;
	border:1px solid #E3E3E3;
   /* border: 1px solid #bebebe;*/
    box-shadow:none;
	border-radius: 4px 4px 4px 4px;
    /*box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;*/
	overflow:hidden;
	}
	.form-horizontal .control-label {
    float: left;
    padding-top: 5px;
    text-align: right;
    width: 125px;
	}
	.form-horizontal .controls 
	{
    margin-left: 140px;
	}
	input.span2, textarea.span2, .uneditable-input.span2 
	{
    width:218px;
	}
	.form-horizontal .control-group 
	{
    margin-bottom:0px;
	}
	.btn
	{
	margin:5px 60px 0px 0px;	
	float:right;
	background-color: #179901;
	background-image: linear-gradient(to bottom, #179901, #1C700E);
	background-repeat: repeat-x;
	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	color: #FFFFFF;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
	outline:none;
	}
	.btn:hover,.btn:focus
	{
	background-color: #179901;
	background-position: 0 -15px;
	color: #fff;
	text-decoration: none;
	transition: background-position 0.1s linear 0s;
	background-image: linear-gradient(to bottom, #179901, #179901);
	outline:none;
	}
	#header_wrapper 
	{
    border-bottom: 1px solid #EBEBEB;
    margin: 0 0 30px;
    padding: 0 0 20px;
	}
</style>

<!--<img src="<?php //echo Yii::app()->urlManager->baseUrl;?>/images/home_pic.png" class="home_pic2">-->

<!--<div><img src="<?php //echo Yii::app()->urlManager->baseUrl;?>/images/home_pic4.jpg" class="home_pic"></div>
-->
<div id="login"> 
<h1>Login Form</h1>
<p >Please note all information is strictly confidential and cannot be shared with unauthorized people.</p>

<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'login-form',
	'type'=>'horizontal',
	//'type'=>'inline',
	
	'enableClientValidation'=>true,
	'clientOptions'=>array(	'validateOnSubmit'=>true,),
    'htmlOptions'=>array('class'=>'well'),
)); ?> 
 
<?php echo $form->textFieldRow($model, 'username', array('class'=>'span2')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span2')); ?>


<?php //echo $form->checkboxRow($model, 'rememberMe'); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Login' /*, 'htmlOptions'=>array('style'=>'float: right; overflow: inherit'),*/)); ?>
 <a style="margin:10px 0 0 142px; float:left; color:#e10000;" href="<?php echo Yii::app()->urlManager->createUrl('site/recoverpassword');?>">Forget password?</a>
<?php $this->endWidget(); ?>

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
//	'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-horizontal', ),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
			
	),
)); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>

	<!--<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); */?>
</div><!-- form -->
</div>
