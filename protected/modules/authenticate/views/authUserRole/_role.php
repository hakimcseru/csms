<style>

.control-group .span {
	float: left;
    margin: 2px 2px 12px 63px;
    padding: 14px 0 12px 1px;
    width: 5px;
}

.controls ul
{
margin:0;
padding:0;
overflow:hidden;
}
.controls ul li
{
margin:0;
padding:0;
list-style-type:none;
font-weight:bold;
display:inline;
float:left;
}
.controls ul li ul li ul li
{
margin:0;
padding:0;
list-style-type:none;
font-weight:normal;
display:inline;
float:left;
}
.span
{
margin:0 !important;
padding:0 !important;
width:150px !important;
height:auto !important;
float:left !important;
}
input[type="checkbox"]
{
margin:4px 5px 0 0 !important;
padding:0 !important;
vertical-align:middle !important;
float:left !important;
}
hr{margin:10px 0px; padding:0; clear:both;} 
    
</style>


<ul>
    <li>
        <span><input type="checkbox" name="All" id="All"></span>
        <span class="span">ALL Select  </span>
		<span><input type="checkbox" id="AllIndex" name="AllIndex" ></span>
        <span class="span">Index </span>
		<span><input type="checkbox" id="AllCreate" name="AllCreate" ></span>
        <span class="span">Create </span>
		<span><input type="checkbox" id="AllUpdate" name="AllUpdate" ></span>
		<span class="span">Update </span>
		<span><input type="checkbox" id="AllAdmin" name="AllAdmin" ></span>
        <span class="span"> Admin</span>
		<br /><br />
		<span><input type="checkbox" id="AllDelete" name="AllDelete" ></span>
		
        <span class="span">Delete </span>
		<span><input type="checkbox" id="AllView" name="AllView" ></span>
        <span class="span">View </span>
		<span><input type="checkbox" id="AllOthers" name="AllOthers" ></span>
        <span class="span">Others </span>

<?php $modules=AuthModule::model()->findAll();

echo '<ul class="mainul">';

foreach($modules as $module):

//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:30px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
echo '<li><input style="float: left;" type="checkbox" name=mod_'.$module->name.'[] value="'.$module->name.'" ';

echo '><span class="span">'.$module->name.'</span> <ul>'; 

$ctrls=AuthController::model()->findAll('module_id='.$module->id,"ORDER BY name ASEC");
	foreach($ctrls as $ctrl):
	
	//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
	echo '<li><input style="float: left;" type="checkbox" name=ctrl_'.$ctrl->name.'[] value="'.$ctrl->name.'" id="select_ctrl"';

	echo '><span class="span">'.$ctrl->name.'</span> <ul>';
	
	
		$actions=AuthAction::model()->findAll('controller_id='.$ctrl->id,"ORDER BY name ASEC");
			foreach($actions as $action):
			
				//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
				echo '<li><input style="float: left;" type="checkbox" name="action[]" value="'.$module->name.'_'.$ctrl->name.'_'.$action->name.'" class="'.$action->name.'"';

				echo '><span class="span">'.$action->name.'</span> </li>';
				
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


echo '<ul class="mainul">'; 

$ctrls=AuthController::model()->findAll(); 

	foreach($ctrls as $ctrl):
		
	//echo	'<div style="border-style:solid; border-width:1px; border-color:#ccc; width:auto; overflow:hidden; padding:10px; margin-bottom:10px;"><div style=" width:auto; overflow:hidden; padding:10px; margin-bottom:10px;">';
	echo '<li><input type="checkbox" style="float: left;"  name=ctrl_'.$ctrl->name.'[] value="'.$ctrl->name.'" id="select_ctrl"';

	echo '><span class="span">'.$ctrl->name.'</span> <ul>';
	
		$actions=AuthAction::model()->findAll('controller_id='.$ctrl->id,"ORDER BY name ASEC");
		
			foreach($actions as $action):
					
				
				echo '<li><input style="float: left;" type="checkbox" name="action[]" value="0_'.$ctrl->name.'_'.$action->name.'" class="'.$action->name.'"';

				echo '><span class="span">'.$action->name.'</span> </li>';
				
				
				
				
				//echo '</div>';	
			endforeach;
			echo '</ul></li>';
	endforeach;

echo '</ul>';

?>

</li></ul>