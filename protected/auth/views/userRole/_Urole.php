
<ul><li><input type="checkbox" name="All[]" ><span class="span">ALL Select  </span>

<?php $modules=AuthModule::model()->findAll();

echo '<ul>';

foreach($modules as $module):

//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:30px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
echo '<li><input type="checkbox" name=mod_'.$module->name.'[] value="'.$module->name.'" ';

echo '> <span class="span">'.$module->name.',</span><ul>'; 

$ctrls=AuthController::model()->findAll('module_id='.$module->id,"ORDER BY name ASEC");
	foreach($ctrls as $ctrl):
	
	//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
	echo '<li><input type="checkbox" name=ctrl_'.$ctrl->name.'[] value="'.$ctrl->name.'" id="select_ctrl"';

	echo '> <span class="span">'.$ctrl->name.',</span><ul>';
	
			$actions=AuthAction::model()->findAll('controller_id='.$ctrl->id,"ORDER BY name ASEC");
			foreach($actions as $action):
					
				
					
				//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
				echo '<li><input type="checkbox" name="action[]" value="'.$module->name.'_'.$ctrl->name.'_'.$action->name.'" class="'.$action->name.'"';
					
					if($model->id) {
					$clt_chk=AuthUserRoleAccess::model()->findAll('role_id='.$model->id);
				foreach($clt_chk as $act):
				if($act->action==$action->name)
				echo 'checked'; 
		
			else echo '' ;
			endforeach;
			}
				echo ' > <span class="span">'.$action->name.',</span></li>';
				
			
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

$ctrls=AuthController::model()->findAll('module_id=0');

	foreach($ctrls as $ctrl):
	echo '<li><input type="checkbox" name=ctrl_'.$ctrl->name.'[] value="'.$ctrl->name.'" id="select_ctrl"';

	echo '> <span class="span">'.$ctrl->name.',</span><ul>';
	
		if($model->id){
		$clt_chk=AuthUserRoleAccess::model()->find('role_id='.$model->id);
		$actions=AuthAction::model()->findAll('controller_id='.$ctrl->id);
		
			foreach($actions as $action):
				
				//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
			
			echo '<li><input type="checkbox" name="action[]" value="0_'.$ctrl->name.'_'.$action->name.'" class="'.$action->name.'"' ;
			
			if($model->id) {
			$clt_chk=AuthUserRoleAccess::model()->findAll('role_id='.$model->id);
				foreach($clt_chk as $act):
				if($act->action==$action->name)
				echo 'checked'; 
		
			else echo '' ;
			endforeach;
			}
				echo '> <span class="span">'.$action->name.',</span></li>';
				
			
				
				
				//echo '</div>';	
			endforeach;
			}
			echo '</ul></li>';
	endforeach;

echo '</ul>';

?>

</li></ul>

