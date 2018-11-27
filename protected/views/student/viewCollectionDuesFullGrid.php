<?php
$total_dues=0;
if($eninfo->full_free=='Yes')
echo '0';
else
{
$collection=StudentCollection::model()->find("student_pk='".$model->student_pk."' and  session_id='".$eninfo->session."' order by month DESC");
//echo "student_pk='".$model->student_pk."' and  session_id='".$eninfo->session."' order by month DESC";
if(isset($collection))
{
if($collection->month==12)
{
//echo "skip";
//echo Bndate::t($total_dues-);
$student_remaining = StudentRemaining::model()->find("student_pk='".$eninfo->student_pk."' and  session_id='".$eninfo->session."'");
$st=0;
if($student_remaining) {$st=$total_dues-$student_remaining->remaining_amount;}

echo Bndate::t($st);

}
else
{
$month=$collection->month;
//echo $eninfo->session;
	$student_dues = StudentDues::model()->findAll("student_pk='".$eninfo->student_pk."' and session_id='".$eninfo->session."'");
	$st_fine=0;
	$st_rem=0;
	$student_fine = StudentFine::model()->find("student_pk='".$eninfo->student_pk."' and session_id='".$eninfo->session."'");
	if($student_fine) $st_fine=$student_fine->amount;
	
	//echo "student_pk='".$eninfo->student_pk."' and  session_id='".$eninfo->session."'";
	
	$student_remaining = StudentRemaining::model()->find("student_pk='".$eninfo->student_pk."' and  session_id='".$eninfo->session."'");
	if($student_remaining) $st_rem=$student_remaining->remaining_amount;
	
	
	
	
	
	
	foreach($student_dues as $sd):
	
	$total_dues+=$sd->due_amount;
	
	$month=$sd->month;
	
	endforeach;
	
	
	
		$collection_head=CollectionHead::model()->find("session='".$eninfo->session."' and course='".$eninfo->course_id."' and student_type='".$eninfo->enrollment_status."' and (apply_on_month='0')");
		
		if($collection_head)
		{
		for($io=($month+1); $io<=12;$io++)
		{
			$total_dues+=$collection_head->collection_amount;
		}
		}
	
	//echo $total_dues."+".$st_fine."-".$st_rem;
	$total_dues=($total_dues+$st_fine)-$st_rem;
	echo Bndate::t($total_dues);
}
}
}


?>


