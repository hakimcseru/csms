<?php

class CollectionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. Seee 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	*/
	public function accessRules()

{

 if(Yii::app()->controller->module)

$module=Yii::app()->controller->module->id;

else $module="0";

$controller=Yii::app()->controller->id;

$action=Yii::app()->controller->action->id;

//echo $module."_".$controller."_".$action;

$accessrole_id=Yii::app()->user->accessrole_id;

//echo Yii::app()->user->name;//die();

$auh_access=AuthUserRoleAccess::model()->findByAttributes(array('role_id'=>$accessrole_id,'module'=>$module,'controller'=>$controller,'action'=>$action));

if($auh_access)

{
return array(

array('allow', // allow admin user to perform 'admin' and 'delete' actions

'actions'=>array($auh_access->action),

'users'=>array(Yii::app()->user->name),

),

array('deny',  // deny all users

'users'=>array("*"),

),

);

}
else{

return array(
array('deny',  // deny all users

'users'=>array('*'),

),

);

}

}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	 
	 public function actionRemission()
	{
		$model=new StudentCollectionDetail;
                $model2= new Student;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentCollectionDetail']))
		{
			$model->attributes=$_POST['StudentCollectionDetail'];
                        $model2=Student::model()->find("student_id='".$_POST['StudentCollectionDetail']['student_id']."'");
						$student_enrollment_info=StudentEnrollmentInfo::model()->find("session='".$_POST['StudentCollectionDetail']['session_id']."' and student_id='".$_POST['StudentCollectionDetail']['student_id']."'");
                        $o=1;
			if($model->save())
                        { 
							//echo $model2->student_id." ".$model->deposite_date." ".$model->month; die();
							StudentFine::model()->deleteAll("student_id=".$model2->student_id." and session_id=".$model->session_id." and year='".$_POST['StudentCollectionDetail']['session_id']."'");
							$this->FinanceProcessFor($model2->student_id,$model->deposite_date,$model->month,$model->session_id);
							
                            $student_fine=StudentFine::model()->find("student_id=".$_POST['StudentCollectionDetail']['student_id']." and year='".$_POST['StudentCollectionDetail']['session_id']."'");
                            $student_dues=StudentDues::model()->findAll("student_id='".$_POST['StudentCollectionDetail']['student_id']."' and year='".$_POST['StudentCollectionDetail']['session_id']."'");
                            
                            
                            
                            $student_remaining=StudentRemaining::model()->find("student_id=".$_POST['StudentCollectionDetail']['student_id']." and session_id='".$_POST['StudentCollectionDetail']['session_id']."'");
                            
                            if($student_remaining) {$total_amount=$student_remaining->remaining_amount+$_POST['StudentCollectionDetail']['collection_amount']; StudentRemaining::model()->deleteAll("id=".$student_remaining->id);}
                            
                            else $total_amount=$_POST['StudentCollectionDetail']['collection_amount'];
                            
                            $last_c=0;
							//$student_fine=0; active this if you avoide fine
							
							
                            if($student_fine)
                            {
									
                                if($total_amount >= $student_fine->amount )
                                {
									if(isset($_POST['StudentCollectionDetail']['discount']))
									{
									if($_POST['StudentCollectionDetail']['discount']>0)
									$fine_amount=$student_fine->amount-$_POST['StudentCollectionDetail']['discount'];
									else $fine_amount=$student_fine->amount;
									}
									else $fine_amount=$student_fine->amount;
									
                                    $mod= new StudentCollection;
                                    $mod->student_pk=$model2->student_pk;
                                    $mod->student_id=$model2->student_id;
									$mod->collection_detail_id=0;
                                    $mod->collection_id=0;
                                    $mod->collection_amount=$fine_amount;
                                    $mod->comment="Fine";
                                    $mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
                                    $mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
                                    $mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
                                    $mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
                                    $mod->session_id=$student_fine->session_id;
                                    $mod->course_id=$_POST['StudentCollectionDetail']['course_id'];
                                    $mod->year=$student_fine->year;
                                    $mod->month=$student_fine->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $fine_amount; 
                                    StudentFine::model()->deleteAll("id=".$student_fine->id);
                                    }
                                }
                             
                            }
                            
                            foreach($student_dues as $student_d):
                                
                                if($total_amount >= $student_d->due_amount )
                                { 
                                    $mod= new StudentCollection;
                                    $mod->student_pk=$model2->student_pk;
                                    $mod->student_id=$model2->student_id;
									$mod->collection_detail_id=$student_d->collection_id;
                                    $mod->collection_id=$student_d->collection_id;
                                    $mod->collection_amount=$student_d->due_amount;
                                    $mod->comment=$student_d->comment;
                                    $mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
                                    $mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
                                    $mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
                                    $mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
                                    $mod->session_id=$student_d->session_id;
                                    $mod->course_id=$student_d->course_id;
                                    $mod->year=$student_d->year;
                                    $mod->month=$student_d->month;
									$last_c=$student_d->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_d->due_amount; 
                                    StudentDues::model()->deleteAll("id=".$student_d->id);
                                    }
                                    
                                    
                                }
                             
                            endforeach;
								
								//echo $last_c; die();
								
								if($last_c<$_POST['StudentCollectionDetail']['month']) $last_c=$_POST['StudentCollectionDetail']['month'];
								
								for($u=($last_c+1);$u<=12;$u++)
								{
									$collection_head=CollectionHead::model()->findAll("session='".$_POST['StudentCollectionDetail']['session_id']."' and course='".$_POST['StudentCollectionDetail']['course_id']."' and student_type='".$student_enrollment_info->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0')");
							
									//echo "session='".$_POST['StudentCollectionDetail']['session_id']."' and course='".$_POST['StudentCollectionDetail']['course_id']."' and student_type='".$model2->EnrollmentInfo->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0')";
								//die();
								
								foreach ($collection_head as $ch)
											
								{       //echo $last_c;die();
								
								$student_collection2=StudentCollection::model()->find("student_id='".$model2->student_id."' and month='".$u."' and year='".$_POST['StudentCollectionDetail']['year']."' and collection_id=$ch->id");
                    
                    
								if($student_collection2);
									else{
									
									if($total_amount>=$ch->collection_amount)
									{
											$mod= new StudentCollection;
											
											$mod->student_pk=$model2->student_pk;
											$mod->student_id=$model2->student_id;
											$mod->collection_detail_id=$ch->id;
											$mod->collection_id=$ch->id;
											$mod->collection_amount=$ch->collection_amount;
											$mod->comment=$ch->head_group->group_name;
											$mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
											$mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
											$mod->bank_id=@$_POST['StudentCollectionDetail']['bank_id'];
											$mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
											$mod->session_id=$_POST['StudentCollectionDetail']['session_id'];
											$mod->course_id=$_POST['StudentCollectionDetail']['course_id'];
											$mod->year=$_POST['StudentCollectionDetail']['year'];
											$mod->month=$u;
											
											$mod->save();
										 $total_amount=$total_amount - $ch->collection_amount;   
									}
									}
									
								
								
						
								}
							}
							
                           
                            if($total_amount>0)
                                {
                                    
                                    $nmod=new StudentRemaining;
                                    $nmod->student_pk=$model2->student_pk;
                                    $nmod->student_id=$model2->student_id;
                                    $nmod->remaining_amount=$total_amount;
                                    $nmod->description='Monthly Payment';
									$nmod->session_id=$_POST['StudentCollectionDetail']['session_id'];
                                    $nmod->save();
                                }
                            
                            
                                Yii::app()->user->setFlash('success','Payment received.');
				$this->refresh();
                        }
                        else $this->render('remission',array(
			'model'=>$model,'model2'=>$model2,'status'=>'show',
                        ));
		}
        elseif(isset($_POST['IDSearchForm']))
		{
                    //$this->FinanceProcess($_POST['IDSearchForm']['searchid']);
					
					CollectionController::FinanceProcess($_POST['IDSearchForm']['searchid']);
					
					//$this->FinanceProcessFor($_POST['IDSearchForm']['searchid'],$_POST['IDSearchForm']['deposit_date'],'',$_POST['IDSearchForm']['session']);
					//StudentEnrollmentInfo::model()->find("");
					
                    $model2=Student::model()->find("student_id='".$_POST['IDSearchForm']['searchid']."'");
					
					
					
                    if($model2)
                    
                   
                    $this->render('remission',array(
			'model2'=>$model2,'model'=>$model,'status'=>'show',
                        ));
                    else
                        $this->render('remission',array(
			'model2'=>$model2,'model'=>$model, 'status'=>'Null',
                        )); 
		}
                else{
		$this->render('remission',array(
			'model'=>$model,'model2'=>$model2,'status'=>'Null',
		));
                }
	}

      
/*	public function actionCreate()
	{
		$model=new StudentCollectionDetail;
                $model2= new Student;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentCollectionDetail']))
		{
			$model->attributes=$_POST['StudentCollectionDetail'];
                        $model2=Student::model()->find("student_id='".$_POST['StudentCollectionDetail']['student_id']."'");
                        $o=1;
			if($model->save())
                        { 
							//echo $model2->student_id." ".$model->deposite_date." ".$model->month; die();
							StudentFine::model()->deleteAll("student_id=".$model2->student_id." and session_id=".$model->session_id." and year='".$_POST['StudentCollectionDetail']['session_id']."'");
							$this->FinanceProcessFor($model2->student_id,$model->deposite_date,$model->month,$model->session_id);
							
                            $student_fine=StudentFine::model()->find("student_id=".$_POST['StudentCollectionDetail']['student_id']." and year='".$_POST['StudentCollectionDetail']['session_id']."'");
                            $student_dues=StudentDues::model()->findAll("student_id='".$_POST['StudentCollectionDetail']['student_id']."' and year='".$_POST['StudentCollectionDetail']['session_id']."'");
                            
                            
                            
                            $student_remaining=StudentRemaining::model()->find("student_id=".$_POST['StudentCollectionDetail']['student_id']." and session_id='".$_POST['StudentCollectionDetail']['session_id']."'");
                            
                            if($student_remaining) {$total_amount=$student_remaining->remaining_amount+$_POST['StudentCollectionDetail']['collection_amount']; StudentRemaining::model()->deleteAll("id=".$student_remaining->id);}
                            
                            else $total_amount=$_POST['StudentCollectionDetail']['collection_amount'];
                            
                            $last_c=0;
							//$student_fine=0; active this if you avoide fine
							
							
                            if($student_fine)
                            {
									
                                if($total_amount >= $student_fine->amount )
                                {
									if(isset($_POST['StudentCollectionDetail']['discount']))
									{
									if($_POST['StudentCollectionDetail']['discount']>0)
									$fine_amount=$student_fine->amount-$_POST['StudentCollectionDetail']['discount'];
									else $fine_amount=$student_fine->amount;
									}
									else $fine_amount=$student_fine->amount;
									
                                    $mod= new StudentCollection;
                                    $mod->student_pk=$model2->student_pk;
                                    $mod->student_id=$model2->student_id;
									$mod->collection_detail_id=0;
                                    $mod->collection_id=0;
                                    $mod->collection_amount=$fine_amount;
                                    $mod->comment="Fine";
                                    $mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
                                    $mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
                                    $mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
                                    $mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
                                    $mod->session_id=$student_fine->session_id;
                                    $mod->course_id=$_POST['StudentCollectionDetail']['course_id'];
                                    $mod->year=$student_fine->year;
                                    $mod->month=$student_fine->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $fine_amount; 
                                    StudentFine::model()->deleteAll("id=".$student_fine->id);
                                    }
                                }
                             
                            }
                            
                            foreach($student_dues as $student_d):
                                
                                if($total_amount >= $student_d->due_amount )
                                { 
                                    $mod= new StudentCollection;
                                    $mod->student_pk=$model2->student_pk;
                                    $mod->student_id=$model2->student_id;
									$mod->collection_detail_id=$student_d->collection_id;
                                    $mod->collection_id=$student_d->collection_id;
                                    $mod->collection_amount=$student_d->due_amount;
                                    $mod->comment=$student_d->comment;
                                    $mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
                                    $mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
                                    $mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
                                    $mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
                                    $mod->session_id=$student_d->session_id;
                                    $mod->course_id=$student_d->course_id;
                                    $mod->year=$student_d->year;
                                    $mod->month=$student_d->month;
									$last_c=$student_d->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_d->due_amount; 
                                    StudentDues::model()->deleteAll("id=".$student_d->id);
                                    }
                                    
                                    
                                }
                             
                            endforeach;
								
								//echo $last_c; die();
								
								if($last_c<$_POST['StudentCollectionDetail']['month']) $last_c=$_POST['StudentCollectionDetail']['month'];
								
								for($u=($last_c+1);$u<=12;$u++)
								{
									$collection_head=CollectionHead::model()->findAll("session='".$_POST['StudentCollectionDetail']['session_id']."' and course='".$_POST['StudentCollectionDetail']['course_id']."' and student_type='".$model2->EnrollmentInfo->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0')");
							
									//echo "session='".$_POST['StudentCollectionDetail']['session_id']."' and course='".$_POST['StudentCollectionDetail']['course_id']."' and student_type='".$model2->EnrollmentInfo->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0')";
								//die();
								
								foreach ($collection_head as $ch)
											
								{       //echo $last_c;die();
								
								$student_collection2=StudentCollection::model()->find("student_id='".$model2->student_id."' and month='".$u."' and year='".$_POST['StudentCollectionDetail']['year']."' and collection_id=$ch->id");
                    
                    
								if($student_collection2);
									else{
									
									if($total_amount>=$ch->collection_amount)
									{
											$mod= new StudentCollection;
											
											$mod->student_pk=$model2->student_pk;
											$mod->student_id=$model2->student_id;
											$mod->collection_detail_id=$ch->id;
											$mod->collection_id=$ch->id;
											$mod->collection_amount=$ch->collection_amount;
											$mod->comment=$ch->head_group->group_name;
											$mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
											$mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
											$mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
											$mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
											$mod->session_id=$_POST['StudentCollectionDetail']['session_id'];
											$mod->course_id=$_POST['StudentCollectionDetail']['course_id'];
											$mod->year=$_POST['StudentCollectionDetail']['year'];
											$mod->month=$u;
											
											$mod->save();
										 $total_amount=$total_amount - $ch->collection_amount;   
									}
									}
									
								
								
						
								}
							}
							
                           
                            if($total_amount>0)
                                {
                                    
                                    $nmod=new StudentRemaining;
                                    $nmod->student_pk=$model2->student_pk;
                                    $nmod->student_id=$model2->student_id;
                                    $nmod->remaining_amount=$total_amount;
                                    $nmod->description='Monthly Payment';
									$nmod->session_id=$_POST['StudentCollectionDetail']['session_id'];
                                    $nmod->save();
                                }
                            
                            
                                Yii::app()->user->setFlash('success','Payment received.');
				$this->refresh();
                        }
                        else $this->render('create',array(
			'model'=>$model,'model2'=>$model2,'status'=>'show',
                        ));
		}
        elseif(isset($_POST['IDSearchForm']))
		{
                    //$this->FinanceProcess($_POST['IDSearchForm']['searchid']);
					
					CollectionController::FinanceProcess($_POST['IDSearchForm']['searchid']);
					
					//$this->FinanceProcessFor($_POST['IDSearchForm']['searchid'],$_POST['IDSearchForm']['deposit_date'],'',$_POST['IDSearchForm']['session']);
					//StudentEnrollmentInfo::model()->find("");
					
                    $model2=Student::model()->find("student_id='".$_POST['IDSearchForm']['searchid']."'");
					
					
					
                    if($model2)
                    
                   
                    $this->render('create',array(
			'model2'=>$model2,'model'=>$model,'status'=>'show',
                        ));
                    else
                        $this->render('create',array(
			'model2'=>$model2,'model'=>$model, 'status'=>'Null',
                        )); 
		}
                else{
		$this->render('create',array(
			'model'=>$model,'model2'=>$model2,'status'=>'Null',
		));
                }
	}
*/



	public function actionCreate()
	{
		$model=new StudentCollectionDetail;
                $model2= new Student;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentCollectionDetail']))
		{
			$model->attributes=$_POST['StudentCollectionDetail'];
                        $model2=Student::model()->find("student_id='".$_POST['StudentCollectionDetail']['student_id']."'");
						$student_enrollment_info=StudentEnrollmentInfo::model()->find("session='".$_POST['StudentCollectionDetail']['session_id']."' and student_id='".$_POST['StudentCollectionDetail']['student_id']."'");
						
						
                        $o=1;
			if($model->save())
                        { 
							//echo $model2->student_id." ".$model->deposite_date." ".$model->month; die();
							StudentFine::model()->deleteAll("student_id=".$model2->student_id." and session_id=".$model->session_id." and year='".$_POST['StudentCollectionDetail']['session_id']."'");
							$this->FinanceProcessFor($model2->student_id,$model->deposite_date,$model->month,$model->session_id);
							
                            $student_fine=StudentFine::model()->find("student_id=".$_POST['StudentCollectionDetail']['student_id']." and year='".$_POST['StudentCollectionDetail']['session_id']."'");
                            $student_dues=StudentDues::model()->findAll("student_id='".$_POST['StudentCollectionDetail']['student_id']."' and year='".$_POST['StudentCollectionDetail']['session_id']."'");
                            
                            
                            
                            $student_remaining=StudentRemaining::model()->find("student_id=".$_POST['StudentCollectionDetail']['student_id']." and session_id='".$_POST['StudentCollectionDetail']['session_id']."'");
                            
                            if($student_remaining) {$total_amount=$student_remaining->remaining_amount+$_POST['StudentCollectionDetail']['collection_amount']; StudentRemaining::model()->deleteAll("id=".$student_remaining->id);}
                            
                            else $total_amount=$_POST['StudentCollectionDetail']['collection_amount'];
                            
                            $last_c=0;
							//$student_fine=0; active this if you avoide fine
							
							
                            if($student_fine)
                            {
									
                                if($total_amount >= $student_fine->amount )
                                {
									if(isset($_POST['StudentCollectionDetail']['discount']))
									{
									if($_POST['StudentCollectionDetail']['discount']>0)
									$fine_amount=$student_fine->amount-$_POST['StudentCollectionDetail']['discount'];
									else $fine_amount=$student_fine->amount;
									}
									else $fine_amount=$student_fine->amount;
									
                                    $mod= new StudentCollection;
                                    $mod->student_pk=$model2->student_pk;
                                    $mod->student_id=$model2->student_id;
									$mod->collection_detail_id=0;
                                    $mod->collection_id=0;
                                    $mod->collection_amount=$fine_amount;
                                    $mod->comment="Fine";
                                    $mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
                                    $mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
                                    $mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
                                    $mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
                                    $mod->session_id=$student_fine->session_id;
                                    $mod->course_id=$_POST['StudentCollectionDetail']['course_id'];
                                    $mod->year=$student_fine->year;
                                    $mod->month=$student_fine->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $fine_amount; 
                                    StudentFine::model()->deleteAll("id=".$student_fine->id);
                                    }
                                }
                             
                            }
                            
                            foreach($student_dues as $student_d):
                                
                                if($total_amount >= $student_d->due_amount )
                                { 
                                    $mod= new StudentCollection;
                                    $mod->student_pk=$model2->student_pk;
                                    $mod->student_id=$model2->student_id;
									$mod->collection_detail_id=$student_d->collection_id;
                                    $mod->collection_id=$student_d->collection_id;
                                    $mod->collection_amount=$student_d->due_amount;
                                    $mod->comment=$student_d->comment;
                                    $mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
                                    $mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
                                    $mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
                                    $mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
                                    $mod->session_id=$student_d->session_id;
                                    $mod->course_id=$student_d->course_id;
                                    $mod->year=$student_d->year;
                                    $mod->month=$student_d->month;
									$last_c=$student_d->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_d->due_amount; 
                                    StudentDues::model()->deleteAll("id=".$student_d->id);
                                    }
                                    
                                    
                                }
                             
                            endforeach;
								
								//echo $last_c; die();
								
								if($last_c<$_POST['StudentCollectionDetail']['month']) $last_c=$_POST['StudentCollectionDetail']['month'];
								
								for($u=($last_c+1);$u<=12;$u++)
								{
									$collection_head=CollectionHead::model()->findAll("session='".$_POST['StudentCollectionDetail']['session_id']."' and course='".$_POST['StudentCollectionDetail']['course_id']."' and student_type='".$student_enrollment_info->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0')");
							
									//echo "session='".$_POST['StudentCollectionDetail']['session_id']."' and course='".$_POST['StudentCollectionDetail']['course_id']."' and student_type='".$model2->EnrollmentInfo->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0')";
								//die();
								
								foreach ($collection_head as $ch)
											
								{       //echo $last_c;die();
								
								$student_collection2=StudentCollection::model()->find("student_id='".$model2->student_id."' and month='".$u."' and year='".$_POST['StudentCollectionDetail']['year']."' and collection_id=$ch->id");
                    
                    
								if($student_collection2);
									else{
									
									if($total_amount>=$ch->collection_amount)
									{
											$mod= new StudentCollection;
											
											$mod->student_pk=$model2->student_pk;
											$mod->student_id=$model2->student_id;
											$mod->collection_detail_id=$ch->id;
											$mod->collection_id=$ch->id;
											$mod->collection_amount=$ch->collection_amount;
											$mod->comment=$ch->head_group->group_name;
											$mod->collection_date=$_POST['StudentCollectionDetail']['collection_date'];
											$mod->collection_type=$_POST['StudentCollectionDetail']['collection_type'];
											$mod->bank_id=$_POST['StudentCollectionDetail']['bank_id'];
											$mod->deposite_date=$_POST['StudentCollectionDetail']['deposite_date'];
											$mod->session_id=$_POST['StudentCollectionDetail']['session_id'];
											$mod->course_id=$_POST['StudentCollectionDetail']['course_id'];
											$mod->year=$_POST['StudentCollectionDetail']['year'];
											$mod->month=$u;
											
											$mod->save();
										 $total_amount=$total_amount - $ch->collection_amount;   
									}
									}
									
								
								
						
								}
							}
							
                           
                            if($total_amount>0)
                                {
                                    
                                    $nmod=new StudentRemaining;
                                    $nmod->student_pk=$model2->student_pk;
                                    $nmod->student_id=$model2->student_id;
                                    $nmod->remaining_amount=$total_amount;
                                    $nmod->description='Monthly Payment';
									$nmod->session_id=$_POST['StudentCollectionDetail']['session_id'];
                                    $nmod->save();
                                }
                            
                            
                                Yii::app()->user->setFlash('success','Payment received.');
				$this->refresh();
                        }
                        else $this->render('create',array(
			'model'=>$model,'model2'=>$model2,'status'=>'show',
                        ));
		}
        elseif(isset($_POST['IDSearchForm']))
		{
                    //$this->FinanceProcess($_POST['IDSearchForm']['searchid']);
					
					CollectionController::FinanceProcess($_POST['IDSearchForm']['searchid']);
					
					//$this->FinanceProcessFor($_POST['IDSearchForm']['searchid'],$_POST['IDSearchForm']['deposit_date'],'',$_POST['IDSearchForm']['session']);
					//StudentEnrollmentInfo::model()->find("");
					
                    $model2=Student::model()->find("student_id='".$_POST['IDSearchForm']['searchid']."'");
					
					
					
                    if($model2)
                    
                   
                    $this->render('create',array(
			'model2'=>$model2,'model'=>$model,'status'=>'show',
                        ));
                    else
                        $this->render('create',array(
			'model2'=>$model2,'model'=>$model, 'status'=>'Null',
                        )); 
		}
                else{
		$this->render('create',array(
			'model'=>$model,'model2'=>$model2,'status'=>'Null',
		));
                }
	}

        
public static function FinanceProcess($id="")
	{
               
				
				$stmodel=Student::model()->find("student_id='".$id."'");
				$lsession=$stmodel->EnrollmentInfoLast->session;
				
				
                $bndate = new Bndate(strtotime(date("Y-m-d")));
                $month=$bndate->BanglaNumMonth2();
                $date=$bndate->get_date();
                $year=$bndate->getBnToEnYear($date[2]);
               
				if($lsession<$year)
				{
				$month=12;
				$year=$lsession;
				}
                $sein=StudentEnrollmentInfo::model()->find("session='$year' and student_id=".$id);
				if($sein)
				{
				
				$previous_fine=StudentCollection::model()->find("student_pk=".$sein->student_pk." and collection_id=0 and session_id=".$year." order by month desc");
				
				$previous_fine2=StudentCollection::model()->find("student_pk=".$sein->student_pk." and session_id=".$year." order by month desc");
				
				if($previous_fine2)
				$d_month=$previous_fine2->month;
				
				else 
				
				
				$d_month=0;
				
				
				
                $count=0;
                
                if($sein)
                {
                StudentDues::model()->deleteAll("student_id=".$id." and session_id=".$year);
				
				if($sein->full_free=="No")
				{
				
                for($i=1;$i<=$month; $i++)
                {
                    
                   // echo "student_id=".$id." and month=".$i." and year=".$year; die();
                    $student_collection=StudentCollection::model()->find("student_id='".$id."' and month='".$i."' and year='".$year."' and collection_id!=0");
                    //if($student_collection) echo " and month=".$i." and year=".$year." ";
                    
                    if($student_collection);
                    else{
                    
                        //print_r($sein); die();
                           // echo "session='$year' and course='";//.$sein->course_id."' ";//and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0')"; die();

                            $collection_head=CollectionHead::model()->findAll("session='$year' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0')");


                            foreach ($collection_head as $ch)
                            {        
 
					$student_collection=StudentCollection::model()->find("student_id='".$sein->student_id."' and session_id='".$year."' and month='".$i."'  and collection_id='".$ch->id."'");
									$student_du=StudentDues::model()->find("student_id='".$sein->student_id."' and session_id='".$year."' and month='".$i."' and collection_id='".$ch->id."'");
				
				if(!isset($student_collection) && !isset($student_du))
				{
                               
                                    $bver=new StudentDues;
                                    $bver->student_pk=$sein->student_pk;
                                    $bver->student_id=$sein->student_id;
                                    $bver->collection_id=$ch->id;
                                    $bver->due_amount=$ch->collection_amount;
                                    $bver->session_id=$year;
                                    $bver->due_date=date("Y-m-d H:i:s");
                                    $bver->course_id=$sein->course_id;
                                    $bver->comment=$ch->head_group->group_name;
                                    $bver->year=$year;
                                    $bver->month=$i;
                                    if($bver->save())
                                    {   
                                        
					//$count=0; // remove this if you want to active fine
                                        
										if($i>$d_month)
										$count++;
                                    }
				}
                               

                            //echo $std->id;
							

                            }
                            
										$amount=0;
										
										
										if($sein->full_free=="Yes") $count=0;
										
										
                                        if($count==4)
										{	
												if($previous_fine)
												$amount=50;
												else $amount=100;
                                        }
                                        elseif($count>4 && $count<=12)
										{
												if($previous_fine)
												$amount=50;
												else $amount=100;
										$amount=$amount+(($count-4)*50);
										}
                                        
										//echo $amount; 
                                        if($amount>0)
                                        {
                                            StudentFine::model()->deleteAll("student_pk=".$sein->student_pk." and year='".$year."'");
                                            $umod=new StudentFine;
                                            $umod->student_pk=$sein->student_pk;
                                            $umod->student_id=$sein->student_id;
                                            $umod->amount=$amount;
                                            $umod->session_id=$year;
                                            $umod->fine_date=date("Y-m-d H:i:s");
                                            $umod->year=$year;
                                            $umod->month=($d_month+($count-3));;
                                            $umod->comment="Fine";
                                            $umod->save();
                                        }
                    //$student_dues=StudentDues::model()->findAll("student_id=".$id);
                    
                    
                    
                    }
                    
                }
				}
                
                }
                
		}	
           
	}
	
	/////////////////////////////  new //////////////
	
	public static function AllStudentProcess2($id="",$year="",$from_id="",$to_id="")
			{
				$bndate = new Bndate(strtotime(date("Y-m-d")));
				$month=$bndate->BanglaNumMonth2(); 
				$date=$bndate->get_date();
				
				if($id)
				$Allstudent=StudentEnrollmentInfo::model()->findAll("session=".$year. " and student_id='".$id."'");
				elseif($from_id && $to_id)
				$Allstudent=StudentEnrollmentInfo::model()->findAll("session=".$year. " and student_pk>='".$from_id."' and student_pk<='".$to_id."' order by student_pk asc");
				
				else $Allstudent=StudentEnrollmentInfo::model()->findAll("session=".$year);
				
				foreach($Allstudent as $student)
				{
					//echo  $student->student_pk."->".$student->student_id."<br>";
					// Delete all status
					StudentRemaining::model()->deleteAll("student_id=".$student->student_id." and session_id=".$year);
					StudentRemaining::model()->deleteAll("student_pk=".$student->student_pk." and session_id=".$year);
					StudentFine::model()->deleteAll("student_id=".$student->student_id." and session_id=".$year);
					StudentFine::model()->deleteAll("student_pk=".$student->student_pk." and session_id=".$year);
					
					// delete all collection head wise of the particular student
					StudentCollection::model()->deleteAll('student_id='.$student->student_id." and session_id=".$year);
					StudentCollection::model()->deleteAll('student_pk='.$student->student_pk." and session_id=".$year);
					
					$student_dues=StudentDues::model()->deleteAll("student_id='".$student->student_id."' and session_id=".$year);
					$student_dues=StudentDues::model()->deleteAll('student_pk='.$student->student_pk."  and session_id=".$year);
					// Process dues for the student
					$student_remaining=StudentRemaining::model()->find("student_id=".$student->student_id." and session_id=".($year-1));
			
					if($student_remaining)
					$first_student_remaining=$student_remaining->remaining_amount;
					else $first_student_remaining=0;
					
					// get all collection of the student
										
					$model=StudentCollectionDetail::model()->findAll("student_id='".$student->student_id."' and session_id=".$year." order by deposite_date ASC");
					
					$g=1;
					foreach($model as $moo)					
                        { 
						if($moo->deposite_date<='2013-04-14')
						$month=1;
						else
						{
						$bndate = new Bndate(strtotime($moo->deposite_date));
						$month=$bndate->BanglaNumMonth2();
						}
						$month=1;
						
						CollectionController::FinanceProcessFor2($student->student_id,$moo->deposite_date,$month,$year);
                        $student_fine=StudentFine::model()->find("student_id=".$student->student_id." and session_id=".$year);
                        $student_dues=StudentDues::model()->findAll("student_id='".$student->student_id."' and session_id=".$year." order by id ASC");

                        $student_remaining=StudentRemaining::model()->find("student_id=".$student->student_id." and session_id=".$year);
                            
						$ifprocess=StudentCollection::model()->find("student_id='".$student->student_id."' and month=1 and session_id='".$year."'");
							
						if($ifprocess)
						$first_student_remaining=0;
							
                        if($student_remaining) 
						{
						$total_amount=$first_student_remaining+$student_remaining->remaining_amount+$moo->collection_amount; 
						StudentRemaining::model()->deleteAll("id=".$student_remaining->id." and session_id=".$year);
						}
                            
                        else $total_amount=$first_student_remaining+$moo->collection_amount;
                            
                        $last_c=0;
							
						if(strtotime($moo->deposite_date)<= strtotime("2013-11-24 00:00:00"))
						$student_fine=0; // to avoide fine please remove this;
                            
						if($student->full_free=="Yes") $student_fine=0;
							
						if($student_fine)
                        {
                                //echo $student_fine->amount; //die();
                                if($total_amount > $student_fine->amount )
                                {
                                    $mod= new StudentCollection;
									$mod->collection_detail_id=$moo->id;
                                    $mod->student_pk=$student->student_pk;
                                    $mod->student_id=$student->student_id;
                                    $mod->collection_id=0;
                                    $mod->collection_amount=$student_fine->amount;
                                    $mod->comment="Fine";
                                    $mod->collection_date=$moo->collection_date;
                                    $mod->collection_type=$moo->collection_type;
                                    $mod->bank_id=$moo->bank_id;
                                    $mod->deposite_date=$moo->deposite_date;
                                    $mod->session_id=$student_fine->session_id;
                                    $mod->course_id=$moo->course_id;
                                    $mod->year=$student_fine->session_id;
                                    $mod->month=$student_fine->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_fine->amount; 
                                    StudentFine::model()->deleteAll("id=".$student_fine->id);
                                    }
                                }
                             
                            }
                            
                            foreach($student_dues as $student_d):
                                
                                if($total_amount >= $student_d->due_amount )
                                { 
                                    $mod= new StudentCollection;
									$mod->collection_detail_id=$moo->id;
                                    $mod->student_pk=$student->student_pk;
                                    $mod->student_id=$student->student_id;
                                    $mod->collection_id=$student_d->collection_id;
                                    $mod->collection_amount=$student_d->due_amount;
                                    $mod->comment=$student_d->comment;
                                    $mod->collection_date=$moo->collection_date;
                                    $mod->collection_type=$moo->collection_type;
                                    $mod->bank_id=$moo->bank_id;
                                    $mod->deposite_date=$moo->deposite_date;
                                    $mod->session_id=$student_d->session_id;
                                    $mod->course_id=$student_d->course_id;
                                    $mod->year=$student_d->session_id;
                                    $mod->month=$student_d->month;
									$last_c=$student_d->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_d->due_amount; 
                                    StudentDues::model()->deleteAll("id=".$student_d->id);
                                    }    
                                }
                             
								endforeach;
								
								
								if($last_c<$month) $last_c=$month;
								//echo "<br />---<br />";
								for($u=($last_c+1);$u<=12;$u++)
								{
								
								//echo $u." ";
								
									
								echo "<br /><br />"."session='".$moo->session_id."' and course='".$moo->course_id."' and student_type='".$student->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0') order by apply_on_month ASC"."<br /><br />";	
								$collection_head=CollectionHead::model()->findAll("session='".$moo->session_id."' and course='".$moo->course_id."' and student_type='".$student->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0') order by apply_on_month ASC");
							
								
								foreach ($collection_head as $ch)
											
								{       //echo $last_c;die();
									
								echo "student_id='".$student->student_id."' and month='".$u."' and year='".$moo->year."' and collection_id=$ch->id "."<br/>";
								
								$student_collection2=StudentCollection::model()->find("student_id='".$student->student_id."' and month='".$u."' and session_id='".$year."' and collection_id=$ch->id");
                    
                    
								if($student_collection2);
									else{
									
									if($total_amount>=$ch->collection_amount)
									{
											$mod= new StudentCollection;
											$mod->collection_detail_id=$moo->id;
											$mod->student_pk=$student->student_pk;
											$mod->student_id=$student->student_id;
											$mod->collection_id=$ch->id;
											$mod->collection_amount=$ch->collection_amount;
											$mod->comment=$ch->head_group->group_name;
											$mod->collection_date=$moo->collection_date;
											$mod->collection_type=$moo->collection_type;
											$mod->bank_id=$moo->bank_id;
											$mod->deposite_date=$moo->deposite_date;
											$mod->session_id=$moo->session_id;
											$mod->course_id=$moo->course_id;
											$mod->year=$moo->session_id;
											$mod->month=$u;
											
											$mod->save();
										 $total_amount=$total_amount - $ch->collection_amount;   
									}
									}
								}
							} 
							
                            if($total_amount>0)
                                { 
                                    $nmod=new StudentRemaining;
                                    $nmod->student_pk=$student->student_pk;
                                    $nmod->student_id=$student->student_id;
                                    $nmod->remaining_amount=$total_amount;
                                    $nmod->description='Monthly Payment';
									$nmod->session_id=$moo->session_id;
                                    $nmod->save();
                                }
								
                                
							$g++;
                        }
                    
		}
        
		
}

public static function FinanceProcessFor2($id="",$date2="",$month,$session="")
	{  	
				// find month and year
				if($month==1)
				$bndate = new Bndate(strtotime(date("Y-m-d")));
				elseif($date2)
				$bndate = new Bndate(strtotime($date2));
				else 
				$bndate = new Bndate(strtotime(date("Y-m-d")));
							                
				$bndate22 = new Bndate(strtotime($date2));
				$month22=$bndate22->BanglaNumMonth2();
				$date22=$bndate22->get_date(); //print_r($date22); 
				$year22=$bndate22->getBnToEnYear($date22[2]);
				
                $date=$bndate->get_date();				
                $year=$bndate->getBnToEnYear($date[2]);
								
				if($year>$session)
				{$year=$session; $month=12;//$month22=12;
				}
				
				if($year22<$session)
				{$month22=1;
				}
				
				if($year22>$session)
				{$month22=12;
				}
				
				// end find year and month
				
				
                $sein=StudentEnrollmentInfo::model()->find("session='$session' and student_id='".$id."'");
				
				if($sein)
				{
								
				$previous_fine=StudentCollection::model()->find("student_pk=".$sein->student_pk." and collection_id=0 and session_id=".$session." order by month desc");
				
				$previous_fine2=StudentCollection::model()->find("student_pk=".$sein->student_pk." and session_id=".$session." order by month desc");
				
				if($previous_fine2)
				$d_month=$previous_fine2->month;
				
				else
				$d_month=0;
                $count=0;
                
                if($sein)
                {
                StudentDues::model()->deleteAll("student_id=".$id." and session_id=".$session);
				//StudentRemaining::model()->deleteAll("student_id=".$id." and session_id=".$year);
                
				if($sein->full_free=="Yes") $month=1; // for full free only enrollment will be there
				//echo $month;
				for($i=1;$i<=$month; $i++)
                {

                            // for full free remove monthly fees
							if($sein->full_free=="Yes")
							$collection_head=CollectionHead::model()->findAll("session='$session' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' ) order by apply_on_month ASC");
				   
							else
							$collection_head=CollectionHead::model()->findAll("session='$session' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0' )  order by apply_on_month ASC");
							
							//echo "wwwwsession='$year' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0' )";
							//die();
                            foreach ($collection_head as $ch)
                            {         

									$student_collection=StudentCollection::model()->find("student_id='".$id."' and session_id='".$session."' and month='".$i."'  and collection_id='".$ch->id."'");
									$student_du=StudentDues::model()->find("student_id='".$id."' and session_id='".$session."' and month='".$i."' and collection_id='".$ch->id."'");
				
										if(!isset($student_collection) && !isset($student_du))
										{
										$bver=new StudentDues;
										$bver->student_pk=$sein->student_pk;
										$bver->student_id=$sein->student_id;
										$bver->collection_id=$ch->id;
										$bver->due_amount=$ch->collection_amount;
										$bver->session_id=$session;
										$bver->due_date=date("Y-m-d H:i:s");
										$bver->course_id=$sein->course_id;
										$bver->comment=$ch->head_group->group_name;
										$bver->year=$session;
										$bver->month=$i;
										
										if($bver->save())
										{   
												
											echo "<br>student_id='".$id."' and session_id='".$session."' and month='".$i."' and  and collection_id='".$ch->id."' collection='".$ch->collection_amount."'<br>";
											if($i>$d_month)
											$count++;
										   
										}
										}
									
							}
							
							
									$count=($month22-$d_month);
									
									if(strtotime($date2)< strtotime("2013-11-25 00:00:00"))
									$count=0;
									
									if($sein->full_free=="Yes") $count=0;
									
                                        $amount=0;
                                        if($count==4)
										{	
												if($previous_fine)
												$amount=50;
												else $amount=100;
                                        }
                                        elseif($count>4 && $count<=12)
										{
												if($previous_fine)
												$amount=50;
												else $amount=100;
										$amount=$amount+(($count-4)*50);
										}
                                        
                                        if($amount>0)
                                        {										
                                            StudentFine::model()->deleteAll("student_pk=".$sein->student_pk." and year='".$session."'");
                                            $umod=new StudentFine;
                                            $umod->student_pk=$sein->student_pk;
                                            $umod->student_id=$sein->student_id;
                                            $umod->amount=$amount;
                                            $umod->session_id=$session;
                                            $umod->fine_date=date("Y-m-d H:i:s");
                                            $umod->year=$session;
                                            $umod->month=($d_month+($count-3));
                                            $umod->comment="Fine";
                                            $umod->save();
                                        }
                               

                            
                    
                }
                
                }
                
			}
           
	}

//////////////// new /////////////////////////
	
	
	
	public function actionAllStudentProcessByDate($pdate="")
			{
			//echo $pdate;
			//echo "DATE_FORMAT(collection_date,'%Y-%m-%d')='".$pdate."' and student_id='10009820'";
		$dd=StudentCollectionDetail::model()->findAll("DATE_FORMAT(collection_date,'%Y-%m-%d')='".$pdate."'");
		
		//echo count($dd);
        foreach($dd as $d):
		//echo " - ".$d->student_id;
		if($d->student_id)
		$this->actionAllStudentProcess($d->student_id,$d->session_id,"","");
		endforeach;
		
}
	
	
	public function actionAllStudentProcess($id="",$year="",$from_id="",$to_id="")
			{
				$bndate = new Bndate(strtotime(date("Y-m-d")));
				$month=$bndate->BanglaNumMonth2(); 
				$date=$bndate->get_date();
				//$year=$bndate->getBnToEnYear($date[2]); 
				//$year=1420; //only for 1420 batch process	
				if($id)
				$Allstudent=StudentEnrollmentInfo::model()->findAll("session=".$year. " and student_id='".$id."'");
				elseif($from_id && $to_id)
				$Allstudent=StudentEnrollmentInfo::model()->findAll("session=".$year. " and student_pk>='".$from_id."' and student_pk<='".$to_id."' order by student_pk asc");
				
				else $Allstudent=StudentEnrollmentInfo::model()->findAll("session=".$year);
				
				foreach($Allstudent as $student)
				{
					echo  $student->student_pk."->".$student->student_id."<br>";
					StudentRemaining::model()->deleteAll("student_id=".$student->student_id." and session_id=".$year);
					StudentRemaining::model()->deleteAll("student_pk=".$student->student_pk." and session_id=".$year);
					
					StudentFine::model()->deleteAll("student_id=".$student->student_id." and session_id=".$year);
					StudentFine::model()->deleteAll("student_pk=".$student->student_pk." and session_id=".$year);
					
					// delete all collection head wise of the particular student
					StudentCollection::model()->deleteAll('student_id='.$student->student_id." and session_id=".$year);
					StudentCollection::model()->deleteAll('student_pk='.$student->student_pk." and session_id=".$year);
					
					$student_dues=StudentDues::model()->deleteAll("student_id='".$student->student_id."' and session_id=".$year);
					$student_dues=StudentDues::model()->deleteAll('student_pk='.$student->student_pk."  and session_id=".$year);
					
					// Process dues for the student
					$student_remaining=StudentRemaining::model()->find("student_id=".$student->student_id." and session_id=".($year-1));
			
					if($student_remaining)
					$first_student_remaining=$student_remaining->remaining_amount;
					else $first_student_remaining=0;
					
					//echo "< Rem > ".$first_student_remaining." < Rem > ";
					
					// get all collection of the student
					echo "<br /><br />"."student_id='".$student->student_id."' and session_id=".$year." order by deposite_date ASC"."<br /><br />";
					
					$model=StudentCollectionDetail::model()->findAll("student_id='".$student->student_id."' and session_id=".$year." order by deposite_date ASC");
					
					//$model2=StudentEnrollmentInfo::model()->find("student_id='".$_POST['StudentCollectionDetail']['student_id']."' and session=".$year);
					//$o=1;
					$g=1;
					foreach($model as $moo)					
                        { 
						
						echo $moo->deposite_date." ";
						if($moo->deposite_date<='2013-04-14')
						$month=1;
						else
						{
						$bndate = new Bndate(strtotime($moo->deposite_date));
						$month=$bndate->BanglaNumMonth2();
						}
						$month=1;
						//$date=$bndate->get_date();
						//$year=$bndate->getBnToEnYear($date[2]); 
				
						//echo $student->student_id." ".$moo->deposite_date." ".$moo->month."<br>";
						/*)if($g==2)
							{
							echo "sdasd"; die();	
							}*/
						$this->FinanceProcessFor($student->student_id,$moo->deposite_date,$month,$year);
                            $student_fine=StudentFine::model()->find("student_id=".$student->student_id." and session_id=".$year);
                            $student_dues=StudentDues::model()->findAll("student_id='".$student->student_id."' and session_id=".$year." order by id ASC");

                            $student_remaining=StudentRemaining::model()->find("student_id=".$student->student_id." and session_id=".$year);
                            
							$ifprocess=StudentCollection::model()->find("student_id='".$student->student_id."' and month=1 and session_id='".$year."'");
							
							if($ifprocess)
							$first_student_remaining=0;
							
                            if($student_remaining) 
							{
							$total_amount=$first_student_remaining+$student_remaining->remaining_amount+$moo->collection_amount; 
							StudentRemaining::model()->deleteAll("id=".$student_remaining->id." and session_id=".$year);
							}
                            
                            else $total_amount=$first_student_remaining+$moo->collection_amount;
                            
                            $last_c=0;
							
							if(strtotime($moo->deposite_date)<= strtotime("2013-11-24 00:00:00"))
							$student_fine=0; // to avoide fine please remove this;
                            
							if($student->full_free=="Yes") $student_fine=0;
							
							if($student_fine)
                            {
                                //echo $student_fine->amount; //die();
                                if($total_amount > $student_fine->amount )
                                {
                                    $mod= new StudentCollection;
									$mod->collection_detail_id=$moo->id;
                                    $mod->student_pk=$student->student_pk;
                                    $mod->student_id=$student->student_id;
                                    $mod->collection_id=0;
                                    $mod->collection_amount=$student_fine->amount;
                                    $mod->comment="Fine";
                                    $mod->collection_date=$moo->collection_date;
                                    $mod->collection_type=$moo->collection_type;
                                    $mod->bank_id=$moo->bank_id;
                                    $mod->deposite_date=$moo->deposite_date;
                                    $mod->session_id=$student_fine->session_id;
                                    $mod->course_id=$moo->course_id;
                                    $mod->year=$student_fine->session_id;
                                    $mod->month=$student_fine->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_fine->amount; 
                                    StudentFine::model()->deleteAll("id=".$student_fine->id);
                                    }
                                }
                             
                            }
                            
                            foreach($student_dues as $student_d):
                                
                                if($total_amount >= $student_d->due_amount )
                                { 
                                    $mod= new StudentCollection;
									$mod->collection_detail_id=$moo->id;
                                    $mod->student_pk=$student->student_pk;
                                    $mod->student_id=$student->student_id;
                                    $mod->collection_id=$student_d->collection_id;
                                    $mod->collection_amount=$student_d->due_amount;
                                    $mod->comment=$student_d->comment;
                                    $mod->collection_date=$moo->collection_date;
                                    $mod->collection_type=$moo->collection_type;
                                    $mod->bank_id=$moo->bank_id;
                                    $mod->deposite_date=$moo->deposite_date;
                                    $mod->session_id=$student_d->session_id;
                                    $mod->course_id=$student_d->course_id;
                                    $mod->year=$student_d->session_id;
                                    $mod->month=$student_d->month;
									$last_c=$student_d->month;
                                    if($mod->save()){
                                    $total_amount=$total_amount - $student_d->due_amount; 
                                    StudentDues::model()->deleteAll("id=".$student_d->id);
                                    }    
                                }
                             
								endforeach;
								
								
								if($last_c<$month) $last_c=$month;
								//echo "<br />---<br />";
								for($u=($last_c+1);$u<=12;$u++)
								{
								
								//echo $u." ";
								
									
								echo "<br /><br />"."session='".$moo->session_id."' and course='".$moo->course_id."' and student_type='".$student->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0') order by apply_on_month ASC"."<br /><br />";	
								$collection_head=CollectionHead::model()->findAll("session='".$moo->session_id."' and course='".$moo->course_id."' and student_type='".$student->enrollment_status."' and ( apply_on_month='$u' or apply_on_month='0') order by apply_on_month ASC");
							
								
								foreach ($collection_head as $ch)
											
								{       //echo $last_c;die();
									
								echo "student_id='".$student->student_id."' and month='".$u."' and year='".$moo->year."' and collection_id=$ch->id "."<br/>";
								
								$student_collection2=StudentCollection::model()->find("student_id='".$student->student_id."' and month='".$u."' and session_id='".$year."' and collection_id=$ch->id");
                    
                    
								if($student_collection2);
									else{
									
									if($total_amount>=$ch->collection_amount)
									{
											$mod= new StudentCollection;
											$mod->collection_detail_id=$moo->id;
											$mod->student_pk=$student->student_pk;
											$mod->student_id=$student->student_id;
											$mod->collection_id=$ch->id;
											$mod->collection_amount=$ch->collection_amount;
											$mod->comment=$ch->head_group->group_name;
											$mod->collection_date=$moo->collection_date;
											$mod->collection_type=$moo->collection_type;
											$mod->bank_id=$moo->bank_id;
											$mod->deposite_date=$moo->deposite_date;
											$mod->session_id=$moo->session_id;
											$mod->course_id=$moo->course_id;
											$mod->year=$moo->session_id;
											$mod->month=$u;
											
											$mod->save();
										 $total_amount=$total_amount - $ch->collection_amount;   
									}
									}
								}
							} 
							
                            if($total_amount>0)
                                { 
                                    $nmod=new StudentRemaining;
                                    $nmod->student_pk=$student->student_pk;
                                    $nmod->student_id=$student->student_id;
                                    $nmod->remaining_amount=$total_amount;
                                    $nmod->description='Monthly Payment';
									$nmod->session_id=$moo->session_id;
                                    $nmod->save();
                                }
								
                                //echo "d";
								
								//die();
							//echo " ".$total_amount." ";
							$g++;
                        }
           // die();             
		}
        
		
}

public static function FinanceProcessFor($id="",$date2="",$month,$session="")
	{  
			echo $session." ";
			   /*
                $student_collection=StudentCollection::model()->findAll("student_id=".$id);
               $student_remaining=StudentRemaining::model()->find("student_id=".$id);
               $student_collection_detail=StudentCollectionDetail::model()->findAll("student_id=".$id);
               $student_dues=StudentDues::model()->findAll("student_id=".$id);
               
                $all_student=StudentEnrollmentInfo::model()->findAll("session='$id'");
                */
				
				 
		
                //echo $id; die();
				//echo "M=".$month." ";
				
				//echo "Date---".$date2;
				
                if($month==1)
				$bndate = new Bndate(strtotime(date("Y-m-d")));
				elseif($date2)
				$bndate = new Bndate(strtotime($date2));
				else 
				$bndate = new Bndate(strtotime(date("Y-m-d")));
							
				
				
                //$month=$bndate->BanglaNumMonth2();
				$bndate22 = new Bndate(strtotime($date2));
				$month22=$bndate22->BanglaNumMonth2();
				$date22=$bndate22->get_date(); //print_r($date22); 
				$year22=$bndate22->getBnToEnYear($date22[2]);
				
                $date=$bndate->get_date();
				//echo $date[2];
                $year=$bndate->getBnToEnYear($date[2]);
				
				//echo $year." ".$session; //die();
				
				if($year>$session)
				{$year=$session; $month=12;//$month22=12;
				}
				
				if($year22<$session)
				{$month22=1;
				}
				
				if($year22>$session)
				{$month22=12;
				}
				
               
			   //echo "session='$year' and student_id=".$id; die();
			   //echo "session='$year' and student_id='".$id."'";
                $sein=StudentEnrollmentInfo::model()->find("session='$session' and student_id='".$id."'");
				
				if($sein)
				{
				//echo "asfsdfsdf". $month;
				//echo "student_pk=".$sein->student_pk." and collection_id=0 and session_id=".$year." order by month desc"; die();
				
				$previous_fine=StudentCollection::model()->find("student_pk=".$sein->student_pk." and collection_id=0 and session_id=".$session." order by month desc");
				
				$previous_fine2=StudentCollection::model()->find("student_pk=".$sein->student_pk." and session_id=".$session." order by month desc");
				
				if($previous_fine2)
				$d_month=$previous_fine2->month;
				
				else 
				
				
				$d_month=0;
				
				//echo "dd-".$d_month.":";
				
                $count=0;
                
                if($sein)
                {
				
				
                StudentDues::model()->deleteAll("student_id=".$id." and session_id=".$session);
				//StudentRemaining::model()->deleteAll("student_id=".$id." and session_id=".$year);
                
				if($sein->full_free=="Yes") $month=1; // for full free only enrollment will be there
				//echo $month;
				for($i=1;$i<=$month; $i++)
                {
                    //echo "sdfsdfs";
                   // echo "student_id=".$id." and month=".$i." and year=".$year; die();
				   
				   //echo "student_id='".$id."' and month='".$i."' and year='".$year."' and collection_id!=0"; echo "<br />";
				   
                    
                    //if($student_collection) echo " and month=".$i." and year=".$year." ";
                    
                    /*if($student_collection); 
                    else{*/
                    
                        //print_r($sein); die();
                           // echo "session='$year' and course='";//.$sein->course_id."' ";//and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0')"; die();

						   
						   
                            // for full free remove monthly fees
							if($sein->full_free=="Yes")
							$collection_head=CollectionHead::model()->findAll("session='$session' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' ) order by apply_on_month ASC");
				   
							else
							$collection_head=CollectionHead::model()->findAll("session='$session' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0' )  order by apply_on_month ASC");
							
							//echo "wwwwsession='$year' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0' )";
							//die();
                            foreach ($collection_head as $ch)
                            {         
                               
//echo $ch->id." | ";							   
									
									$student_collection=StudentCollection::model()->find("student_id='".$id."' and session_id='".$session."' and month='".$i."'  and collection_id='".$ch->id."'");
									$student_du=StudentDues::model()->find("student_id='".$id."' and session_id='".$session."' and month='".$i."' and collection_id='".$ch->id."'");
				
										if(!isset($student_collection) && !isset($student_du))
										{
										$bver=new StudentDues;
										$bver->student_pk=$sein->student_pk;
										$bver->student_id=$sein->student_id;
										$bver->collection_id=$ch->id;
										$bver->due_amount=$ch->collection_amount;
										$bver->session_id=$session;
										$bver->due_date=date("Y-m-d H:i:s");
										$bver->course_id=$sein->course_id;
										$bver->comment=$ch->head_group->group_name;
										$bver->year=$session;
										$bver->month=$i;
										
										if($bver->save())
										{   
												
											echo "<br>student_id='".$id."' and session_id='".$session."' and month='".$i."' and  and collection_id='".$ch->id."' collection='".$ch->collection_amount."'<br>";
											if($i>$d_month)
											$count++;
										   
										}
										}
									
							}
							//die();
							//echo $count;
							
									$count=($month22-$d_month);
									//echo "\n -- (".$month22."-".$d_month.") -- \n";
									if(strtotime($date2)< strtotime("2013-11-25 00:00:00"))
									$count=0;
									
									if($sein->full_free=="Yes") $count=0;
									//else $count++									
									//$count=0; // remove this if you want to active fine
					
										//echo $count;
                                        $amount=0;
                                        if($count==4)
										{	
												if($previous_fine)
												$amount=50;
												else $amount=100;
                                        }
                                        elseif($count>4 && $count<=12)
										{
												if($previous_fine)
												$amount=50;
												else $amount=100;
										$amount=$amount+(($count-4)*50);
										}
                                        
                                        if($amount>0)
                                        {										
                                            StudentFine::model()->deleteAll("student_pk=".$sein->student_pk." and year='".$session."'");
                                            $umod=new StudentFine;
                                            $umod->student_pk=$sein->student_pk;
                                            $umod->student_id=$sein->student_id;
                                            $umod->amount=$amount;
                                            $umod->session_id=$session;
                                            $umod->fine_date=date("Y-m-d H:i:s");
                                            $umod->year=$session;
                                            $umod->month=($d_month+($count-3));
                                            $umod->comment="Fine";
                                            $umod->save();
                                        }
                               

                            //echo $std->id;

                            
							
                            
                    
                    //$student_dues=StudentDues::model()->findAll("student_id=".$id);
                    
                    
                    
                    /*}*/
                    
                }
                
                }
                
			}
           
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentCollection']))
		{
			$model->attributes=$_POST['StudentCollection'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('StudentCollection');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentCollection('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentCollection']))
			$model->attributes=$_GET['StudentCollection'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	   public function actionExport()
	{
		
                
        $model=new StudentCollection('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentCollection']))
			$model->attributes=$_GET['StudentCollection'];
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
			'columns'=>array(
		'id',
		'collection_detail_id',
		//'student_pk',
		'student_id',
		'collection_id',
		array(
		'name'=>'collection_amount',
		'type'=>'raw',
		'footer'=>$model->getTotalss('collection_amount',$model->search()->getKeys()), 
				
		),
		
		'comment',
		'session_id',
		/*
		'collection_date',
		'collection_type',
		'bank_id',
		'deposite_date',
		
		'course_id',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}',
		),
	),
	
			 'exportType'=>'Excel5',
			 'filename'=>'Collection',
                ));
                
                
	}
	 
	public function loadModel($id)
	{
		$model=StudentCollection::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-collection-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
