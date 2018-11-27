<div class ="span3 well">
<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'New Student', 'itemOptions'=>array('class'=>'nav-header')),
        array('label'=>'Add Student', 'icon'=>'plus', 'url'=>'new'),
    ),
)); ?>
</div>
<div class ="span3 well">
<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Student Administration', 'itemOptions'=>array('class'=>'nav-header')),
        array('label'=>'Browse Students', 'icon'=>'asterisk', 'url'=>'browse'),
    ),
)); ?>
</div>
