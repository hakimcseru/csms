<style>
.control-group .span {
	float: left;
    margin: 2px 2px 12px 63px;
    padding: 14px 0 12px 1px;
    width: 5px;
}
li{
display: inline;
    float: left;
}
</style>
<ul><li><input type="checkbox" name="All[]" ><span class="span">ALL Select  </span>

<?php $modules=AuthModule::model()->findAll();

echo '<ul>';

foreach($modules as $module):

//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:30px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
echo '<li><span class="span">'.$module->name.'</span><input type="checkbox" name=mod_'.$module->name.'[] value="'.$module->name.'" ';

echo '> <ul>'; 

$ctrls=AuthController::model()->findAll('module_id='.$module->id,"ORDER BY name ASEC");
	foreach($ctrls as $ctrl):
	
	//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
	echo '<li><span class="span">'.$ctrl->name.'</span><input type="checkbox" name=ctrl_'.$ctrl->name.'[] value="'.$ctrl->name.'" id="select_ctrl"';

	echo '> <ul>';
	
	
		$actions=AuthAction::model()->findAll('controller_id='.$ctrl->id,"ORDER BY name ASEC");
			foreach($actions as $action):
			
				//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
				echo '<li><span class="span">'.$action->name.'</span><input type="checkbox" name="action[]" value="'.$module->name.'_'.$ctrl->name.'_'.$action->name.'" class="'.$action->name.'"';

				echo '> </li>';
				
				//echo '</div>';	
			endforeach;
			echo '</ul></li>';
	endforeach;

echo '</ul></li>';
endforeach;  





echo '</ul>';

?>
<hr>
<?php 


echo '<ul>'; 

$ctrls=AuthController::model()->findAll('module_id=0',"ORDER BY name ASEC");

	foreach($ctrls as $ctrl):
		
	//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
	echo '<li><span class="span">'.$ctrl->name.'</span><input type="checkbox" name=ctrl_'.$ctrl->name.'[] value="'.$ctrl->name.'" id="select_ctrl"';

	echo '> <ul>';
	
		$actions=AuthAction::model()->findAll('controller_id='.$ctrl->id,"ORDER BY name ASEC");
		
			foreach($actions as $action):
					
				
				echo '<li><span class="span">'.$action->name.'</span><input type="checkbox" name="action[]" value="0_'.$ctrl->name.'_'.$action->name.'" class="'.$action->name.'"';

				echo '> </li>';
				
				
				
				
				//echo '</div>';	
			endforeach;
			echo '</ul></li>';
	endforeach;

echo '</ul>';

?>

</li></ul>

