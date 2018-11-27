<?php $this->beginContent('//layouts/main'); ?>
<div class="span3 well">
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'LIST HEADER'),
       array('label'=>Yii::t('menu','Home'), 'icon'=>'home', 'url'=>'#', 'active'=>true),
        array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
        array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
        array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
        array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
        array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
    ),
)); ?>
</div>
<div class="span7 well main">
	<?php echo $content ?>
</div>
<div class="span2 well">
	<?php
	if(isset($this->menu)){
		$this->widget('bootstrap.widgets.BootMenu', array(
			'type'=>'list',
			'items'=>$this->menu,
			//'htmlOptions'=>array('class'=>'operations'),
		));
	}
	?>
</div>
<?php $this->endContent(); ?>
