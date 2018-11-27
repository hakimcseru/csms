

<h1 style="text-align: center"> <?php echo Yii::t('core','Attendance') ?></h1>

<?php 
if($mess=Yii::app()->user->getFlash('success'))
echo '<div class="alert fade in alert-info" style="font-size:18px;"><a data-dismiss="alert" class="close" href="#">×</a><span>'.$mess.'</span></div>';
elseif($mess=Yii::app()->user->getFlash('error'))
echo '<div class="alert in alert-block fade alert-error" style="font-size:18px;"><a data-dismiss="alert" class="close" href="#">×</a><span>'.$mess.'</span></div>';
?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->passwordFieldRow($model, 'student_reg_no', array('class'=>'input-xlarge', 'prepend'=>'<i class="icon-search"></i>')); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
 
<?php $this->endWidget(); ?>

