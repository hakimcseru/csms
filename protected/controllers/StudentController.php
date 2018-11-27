<?php

class StudentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
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
				'actions'=>array('index','view','Course','Cemester'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','qcreate','DisCoor','Group'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('manage','delete','qcreate','DisCoor','Upload'),
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
		$model=$this->loadModel($id);
		CollectionController::FinanceProcess($model->student_id);
		$this->render('view',array(
			'model'=>$model,
		));
	}
public function actionSearchByRegNo()
	{
		
		if(isset($_POST['searchid']))
		{

		$model=Student::model()->find("student_id='".$_POST['searchid']."'");
		if($model)
		{
		CollectionController::FinanceProcess($model->student_id);
		$this->render('view',array(
			'model'=>$this->loadModel($model->student_pk),
		));
		
		}
		else throw new CHttpException(404,'The specified post cannot be found.');
		}
		else throw new CHttpException(404,'The specified post cannot be found.');
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout='//layouts/column2';
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->student_pk));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
public function totaldues($eninfo,$model)	
{
			$total_dues=0;
		if($eninfo->full_free=='Yes')
		echo '0';
		else
		{
		$collection=StudentCollection::model()->find("student_pk='".$model->student_pk."' and  session_id='".$eninfo->session."' order by month DESC");
		//echo "student_pk='".$model->student_pk."' and  session_id='".$eninfo->session."' order by month DESC";

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
			
			}

			}
			return $total_dues;
}
	
	public function actionMinpay() {
	
				
				if($_POST['Student']['full_free']=="Yes")
				$collection_head=CollectionHead::model()->findAll("session='".$_POST['Student']['session']."' and course='".$_POST['Student']['batch_ref_course_pk']."' and student_type='".$_POST['Student']['enrollment_status']."' and ( apply_on_month='1')");
				
				else
				$collection_head=CollectionHead::model()->findAll("session='".$_POST['Student']['session']."' and course='".$_POST['Student']['batch_ref_course_pk']."' and student_type='".$_POST['Student']['enrollment_status']."' and ( apply_on_month='1' or apply_on_month='0')");
				//echo count($collection_head);
				//echo "session='".$_POST['Student']['session']."' and course='".$_POST['Student']['batch_ref_course_pk']."' and student_type='".$_POST['Student']['enrollment_status']."' and ( apply_on_month='1' or apply_on_month='0')";
				//die();
				$minpay=0;
		
				foreach($collection_head as $sh):
				
				if($sh->apply_on_month==0) $mm=$sh->collection_amount*3;
				else $mm=$sh->collection_amount;
				
				$minpay=$minpay+$mm;
				endforeach;
	
				//echo $minpay;
				
				echo CHtml::tag('option',
							   array('value'=>$minpay),$minpay,true);
				
  }
	
	public function actionDisCoor() {
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['Student']['batch_ref_course_pk']);
                 $data=CHtml::listData($model,'batch_pk','batch_id');
				
				echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
							   
				foreach($data as $value=>$name)
				{
					echo CHtml::tag('option',
							   array('value'=>$value),CHtml::encode($name),true);
				}
  }
	
	
	
	public function actionCemester() {
	
				//echo $_POST['CourseSemesterLebel']['course_id'];
				
				$model = Course::model()->findByPk($_POST['Student']['batch_ref_course_pk']);
				
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				if($model->semester)
				{
				
				for($i=0;$i<=$model->semester;$i++)
				{
				if($i==0)
				echo CHtml::tag('option',
							   array('value'=>''),'Pleae Select',true);
				else
				{
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$_POST['Student']['batch_ref_course_pk']." and semester_id=".$i);
					echo CHtml::tag('option',
							   array('value'=>$i),$clebel->lebel,true);
				}
				}
				}
				
  }
	
	public function actionCourse() {
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['Student']['batch_ref_course_pk']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($model as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->department->id),CHtml::encode($mod->department->department_name),true);
				}
  }
  
  public function actionGroup() {
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['Student']['batch_ref']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($model as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->id),CHtml::encode($mod->group_name),true);
				}
  }
  
  
	
	public function actionQcreate()
	{
		//$this->layout='//layouts/column2';
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			
			$model->student_id= $model->student_id; 
			
			
			
			
			if($model->save())
				{
				
				$model2=new StudentEnrollmentInfo;
				
				$model3 = StudentEnrollmentInfo::model()->find("course_id=".$_POST['Student']['batch_ref_course_pk']." and batch_id=".$_POST['Student']['batch_ref']." and department_id=".$_POST['Student']['department_id']." and batch_group=".$_POST['Student']['batch_group']." and semester=".$_POST['Student']['semester']." and session=".$_POST['Student']['session']." order by roll_no DESC");
				
				if($model3)
                                $roll_no=$model3->roll_no+1; 
                                
                                else $roll_no=1;
				
			
				
				$model2->student_pk=$model->student_pk;
				$model2->student_id=$model->student_id;
				$model2->full_free=$_POST['Student']['full_free'];
				$model2->comment=$_POST['Student']['comment'];
				$model2->course_id=$_POST['Student']['batch_ref_course_pk'];
				$model2->batch_id=$_POST['Student']['batch_ref'];
				$model2->bank_id=$_POST['Student']['bank_info'];
				$model2->department_id=$_POST['Student']['department_id'];
				
				$model2->batch_group=$_POST['Student']['batch_group'];
				$model2->enrollment_status=$_POST['Student']['enrollment_status'];
				
				$model2->roll_no=$roll_no;
				
				$model2->admission_reference=$_POST['Student']['admission_reference'];
				
				
				$model2->total_deposit=$_POST['Student']['total_deposit'];
				$model2->deposit_date=$_POST['Student']['date_of_deposit'];
				$model2->semester=$_POST['Student']['semester'];
				$model2->session=$_POST['Student']['session'];
				$model2->input_datetime=date("Y-m-d H:i:s");
				
				if($model2->save())
					{
						$this->actionSingleFirstProcess($model->student_pk,$model2->session,$model2->full_free);
						$this->redirect(array('/studentEnrollmentInfo/view','id'=>$model2->id));
						
					}
					else $model->delete();
					
				}
				
		}

		$this->render('qcreate',array(
			'model'=>$model,
		));
	}
	
	public function actionExamres()
	{
		//$this->layout='//layouts/column2';
		$model=new Student;
		
		if(isset($_POST['Student']))
		{
			
			$model22=Student::model()->find("student_id=".$_POST['Student']['student_id']);
			
			if($model22)
			{
			$model->attributes=$_POST['Student'];			
			//$model->student_id= $model->student_id; 			
			$model=Student::model()->find("student_id=".$_POST['Student']['student_id']);	
			
			} else {  //print_r($_POST['Student']);
			$model->attributes=$_POST['Student'];
			
			//echo $model->student_id;
			
			//$model->student_id= $model->student_id; $model->attributes=$_POST['Student'];
			if($model->save()) echo "Hoise"; else  var_dump($model->getErrors());}
							
			$model2=new StudentEnrollmentInfo;
			$model3 = StudentEnrollmentInfo::model()->find("course_id=".$_POST['Student']['batch_ref_course_pk']." and batch_id=".$_POST['Student']['batch_ref']." and department_id=".$_POST['Student']['department_id']." and batch_group=".$_POST['Student']['batch_group']." and semester=".$_POST['Student']['semester']." and session=".$_POST['Student']['session']." order by roll_no DESC");
				
			if($model3)
            $roll_no=$model3->roll_no+1;                         
            else $roll_no=1;
			$model2->student_pk=$model->student_pk;
			$model2->student_id=$model->student_id;
			$model2->full_free=$_POST['Student']['full_free'];
			$model2->comment=$_POST['Student']['comment'];
			$model2->course_id=$_POST['Student']['batch_ref_course_pk'];
			$model2->batch_id=$_POST['Student']['batch_ref'];
			$model2->bank_id=$_POST['Student']['bank_info'];
			$model2->department_id=$_POST['Student']['department_id'];				
			$model2->batch_group=$_POST['Student']['batch_group'];
			$model2->enrollment_status="Reexam";//$_POST['Student']['enrollment_status'];
			$model2->roll_no=$roll_no;
			//$model2->admission_reference=$_POST['Student']['admission_reference'];
				
			$model2->total_deposit=$_POST['Student']['total_deposit'];
			$model2->deposit_date=$_POST['Student']['date_of_deposit'];
			$model2->semester=$_POST['Student']['semester'];
			$model2->session=$_POST['Student']['session'];
			$model2->input_datetime=date("Y-m-d H:i:s");
				//echo "zxczx"; die();
			if($model2->save())
			{
			//echo "Hoise"; die();
			$this->actionSingleFirstProcess($model->student_pk,$model2->session,$model2->full_free);

			$this->redirect(array('/studentEnrollmentInfo/view','id'=>$model2->id));	
			}
			//else echo "Hoi nai"; die();
					//else $model->delete();													
		}
		elseif(isset($_POST['IDSearchForm']))
		{
			//$this->FinanceProcess($_POST['IDSearchForm']['searchid']);
			
			
						
			$model=Student::model()->find("student_id='".$_POST['IDSearchForm']['searchid']."'");
               
				
			
			$this->render('examres',array(
			'model'=>$model,
			));         
		}
		else{
		$this->render('examres',array(
			'model'=>$model,
		));
		}
	}
	
	public function actionRQcreate()
	{
		//$this->layout='//layouts/column2';
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			
			$model->student_id= $model->student_id; 
			
			$model=Student::model()->find("student_id=".$_POST['Student']['student_id']);
			
			
			
				$model2=new StudentEnrollmentInfo;
				
				$model3 = StudentEnrollmentInfo::model()->find("course_id=".$_POST['Student']['batch_ref_course_pk']." and batch_id=".$_POST['Student']['batch_ref']." and department_id=".$_POST['Student']['department_id']." and batch_group=".$_POST['Student']['batch_group']." and semester=".$_POST['Student']['semester']." and session=".$_POST['Student']['session']." order by roll_no DESC");
				
				if($model3)
                                $roll_no=$model3->roll_no+1; 
                                
                                else $roll_no=1;
				
			
				
				$model2->student_pk=$model->student_pk;
				$model2->student_id=$model->student_id;
				$model2->full_free=$_POST['Student']['full_free'];
				$model2->comment=$_POST['Student']['comment'];
				$model2->course_id=$_POST['Student']['batch_ref_course_pk'];
				$model2->batch_id=$_POST['Student']['batch_ref'];
				$model2->bank_id=$_POST['Student']['bank_info'];
				$model2->department_id=$_POST['Student']['department_id'];
				
				$model2->batch_group=$_POST['Student']['batch_group'];
				$model2->enrollment_status=$_POST['Student']['enrollment_status'];
				
				$model2->roll_no=$roll_no;
				
				$model2->admission_reference=$_POST['Student']['admission_reference'];
				
				
				$model2->total_deposit=$_POST['Student']['total_deposit'];
				$model2->deposit_date=$_POST['Student']['date_of_deposit'];
				$model2->semester=$_POST['Student']['semester'];
				$model2->session=$_POST['Student']['session'];
				$model2->input_datetime=date("Y-m-d H:i:s");
				
				if($model2->save())
					{
						//$this->actionSingleFirstProcess($model->student_pk,$model2->session,$model2->full_free);
						
							$smod=new StudentCollectionDetail;
                            $smod->student_pk=$model->student_pk;
                            $smod->student_id=$model->student_id;
                            $smod->collection_amount=$_POST['Student']['total_deposit'];
                            $smod->comment=$_POST['Student']['enrollment_status']." enrollment";
                            $smod->collection_date=$model2->input_datetime;
                            $smod->collection_type='Cheque';
                            $smod->bank_id=$model2->bank_id;
                            $smod->deposite_date=$model2->deposit_date;
                            $smod->session_id=$model2->session;
                            $smod->course_id=$model2->course_id;
                            $smod->year=$model2->session;
                            $smod->month=1;
                            $smod->collection_for=$_POST['Student']['enrollment_status']." enrollment";
                            if(!$smod->save()) var_dump($smod->getErrors());
							
							// i put this off due to faster the process
							//CollectionController::AllStudentProcess2($model->student_id,$model2->session,"","");
							
						$this->redirect(array('/studentEnrollmentInfo/view','id'=>$model2->id));
						
					}
					//else $model->delete();
					
				
				
		}
		elseif(isset($_POST['IDSearchForm']))
		{
                    //$this->FinanceProcess($_POST['IDSearchForm']['searchid']);
					$session22=$_POST['IDSearchForm']['session'];
					/*$student_ee=StudentEnrollmentInfo::model()->find("student_id='".($_POST['IDSearchForm']['searchid'])."' and session='".($_POST['IDSearchForm']['session']-1)."'");
					if($student_ee)
					{
					$session22=$_POST['IDSearchForm']['session']-1;
					CollectionController::FinanceProcessFor($_POST['IDSearchForm']['searchid'],$_POST['IDSearchForm']['deposit_date'],'',$session22);
					}
					else 
					{
						$student_ee=StudentEnrollmentInfo::model()->find("student_id='".($_POST['IDSearchForm']['searchid'])."' and session='".($_POST['IDSearchForm']['session']-2)."'");
						if($student_ee)
							{
							$session22=$_POST['IDSearchForm']['session']-2;
							//CollectionController::FinanceProcessFor($_POST['IDSearchForm']['searchid'],$_POST['IDSearchForm']['deposit_date'],'',$session22);
							CollectionController::FinanceProcess($_POST['IDSearchForm']['searchid']);
							}
					}*/
					
					//StudentEnrollmentInfo::model()->find("");
					CollectionController::FinanceProcess($_POST['IDSearchForm']['searchid']);
					$model=Student::model()->find("student_id='".$_POST['IDSearchForm']['searchid']."'");
                   
        $this->render('rqcreate',array(
			'model'=>$model,'session'=>$session22,
		));      
                   
                   
                        
		}
		else{
		$this->render('rqcreate',array(
			'model'=>$model,
		));
		}
	}
	
	public function actionSingleFirstProcess2($id,$session,$full_free)
	{
		        
               
                    
                            $smod=new StudentCollectionDetail;
                            $smod->student_pk=$std->student_pk;
                            $smod->student_id=$std->student_id;
                            $smod->collection_amount=$deposit;
                            $smod->comment=$enrollment_status." enrollment";
                            $smod->collection_date=$std->input_datetime;
                            $smod->collection_type='Cheque';
                            $smod->bank_id=$std->bank_id;
                            $smod->deposite_date=$std->deposit_date;
                            $smod->session_id=$session;
                            $smod->course_id=$course_id;
                            $smod->year=$session;
                            $smod->month=1;
                            $smod->collection_for=$enrollment_status." enrollment";
                            if(!$smod->save()) var_dump($smod->getErrors()); 
                            
                            
              
	}
	
	
	public function actionSingleFirstProcess($id,$session,$full_free)
	{
		        
               StudentCollection::model()->deleteAll("student_pk=".$id." and session_id=".$session);
               StudentRemaining::model()->deleteAll("student_pk=".$id." and session_id=".$session);
               StudentCollectionDetail::model()->deleteAll("student_pk=".$id." and session_id=".$session);
               StudentDues::model()->deleteAll("student_pk=".$id);
                //$all_student=StudentEnrollmentInfo::model()->findAll("session='$id'");
                $std=StudentEnrollmentInfo::model()->find("student_pk=".$id." and session=".$session);
                
                
		//foreach($all_student as $std)
                //{
                    $course_id=$std->course_id;
                    $session=$std->session;
                    $deposit=$std->total_deposit;
                    $enrollment_status=$std->enrollment_status;
                    $tatal_deposit=$std->total_deposit;
                    
                            $smod=new StudentCollectionDetail;
                            $smod->student_pk=$std->student_pk;
                            $smod->student_id=$std->student_id;
                            $smod->collection_amount=$deposit;
                            $smod->comment=$enrollment_status." enrollment";
                            $smod->collection_date=$std->input_datetime;
                            $smod->collection_type='Cheque';
                            $smod->bank_id=$std->bank_id;
                            $smod->deposite_date=$std->deposit_date;
                            $smod->session_id=$session;
                            $smod->course_id=$course_id;
                            $smod->year=$session;
                            $smod->month=1;
                            $smod->collection_for=$enrollment_status." enrollment";
                            if(!$smod->save()) var_dump($smod->getErrors()); 
                            
                            
              
				 
				if($full_free=="Yes" || $enrollment_status=='Reexam')
				{
					$collection_head=CollectionHead::model()->findAll("session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='1')");
                    
                    
                    foreach ($collection_head as $ch)
                                
                    {         
                        
                        if($tatal_deposit>=$ch->collection_amount)
                        {
                                $mod= new StudentCollection;
                                
                                $mod->student_pk=$std->student_pk;
                                $mod->student_id=$std->student_id;
                                $mod->collection_id=$ch->id;
                                $mod->collection_amount=$ch->collection_amount;
                                $mod->comment=$ch->head_group->group_name;
                                $mod->collection_date=$std->deposit_date;
                                $mod->collection_type='Cash';
                                $mod->bank_id=$std->bank_id;
                                $mod->deposite_date=$std->deposit_date;
                                $mod->session_id=$session;
                                $mod->course_id=$course_id;
                                $mod->year=$session;
                                $mod->month=1;
                                
                                $mod->save();
                             $tatal_deposit=$tatal_deposit - $ch->collection_amount;   
                        }
                        
                    
                    //echo $std->id;
                    
                    }
				}
				else
				{
					
					
                    for($i=1;$i<=12;$i++)
                    {
                    
					
                    $collection_head=CollectionHead::model()->findAll("session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='$i' or apply_on_month='0')");
                    
					
					
                    
                    foreach ($collection_head as $ch)
                                
                    {        

						//echo "session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='$i' or apply_on_month='0')"; die();
                        
                        if($tatal_deposit>=$ch->collection_amount)
                        {
                                $mod= new StudentCollection;
                                
                                $mod->student_pk=$std->student_pk;
                                echo $mod->student_id=$std->student_id;
                                $mod->collection_id=$ch->id;
                                $mod->collection_amount=$ch->collection_amount;
                                $mod->comment=$ch->head_group->group_name;
                                $mod->collection_date=$std->deposit_date;
                                $mod->collection_type='Cash';
                                $mod->bank_id=$std->bank_id;
                                $mod->deposite_date=$std->deposit_date;
                                $mod->session_id=$session;
                                $mod->course_id=$course_id;
                                $mod->year=$session;
                                $mod->month=$i;
                                
                                if(!$mod->save()) var_dump($mod->getErrors()); 
                             $tatal_deposit=$tatal_deposit - $ch->collection_amount;   
                        }
                        else  
                            
                        {
						/*
						 if($i<=6)
						 {
                            $bver=new StudentDues;
                            $bver->student_pk=$std->student_pk;
                            $bver->student_id=$std->student_id;
                            $bver->collection_id=$ch->id;
                            $bver->due_amount=$ch->collection_amount;
                            $bver->session_id=$session;
                            $bver->due_date='';
                            $bver->course_id=$course_id;
                            $bver->comment=$ch->head_group->group_name;
                            $bver->year=$session;
                            $bver->month=$i;
                            $bver->save();
							}
							*/
                        }
                    
                    //echo $std->id;
                    
                    }
                    }
                }    
                    if($tatal_deposit)
                    {
                        $nmod=new StudentRemaining;
                        $nmod->student_pk=$std->student_pk;
                        $nmod->student_id=$std->student_id;
                        $nmod->remaining_amount=$tatal_deposit;
                        $nmod->description='Enrollment';
						$nmod->session_id=$session;
                        $nmod->save();
                    }
                    
                    
                //}
                
                /*
		$this->render('create',array(
			'model'=>$model,
		));
                 
                 */
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

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save())
                        {
                                $new_st_info=StudentEnrollmentInfo::model()->find("student_pk=".$model->student_pk);
                                if($new_st_info)
                                    {
                                        $new_st_info->student_id=$model->student_id;
                                        $new_st_info->save();
                                    }
                                
				$this->redirect(array('view','id'=>$model->student_pk));
                        }
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
			
			//$this->loadModel($id)->delete();
			
			$model=$this->loadModel($id);
			$model2=StudentEnrollmentInfo::model()->find("student_pk=".$model->student_pk);
			if($model2)
			$model2->delete();
			$model->delete();
			
			
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
		$dataProvider=new CActiveDataProvider('Student');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionGetExportFile()
            {
                Yii::app()->request->sendFile('export.csv',Yii::app()->user->getState('export'));
                Yii::app()->user->clearState('export');
            }


	public function actionUpload($id)
	{
		
		
	
		Yii::import("ext.EAjaxUpload.qqFileUploader");
		
		//if($er) echo "Ase"; else "Nai";
		
		$folder=Yii::app()->basePath.'/../images/student/';// folder for uploaded files
		
		$allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
		$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
		$fileName=$result['filename'];//GETTING FILE NAME
		
		if($fileName)
		{
		$model=$this->loadModel($id);
		
		if(isset($model->student_image) && file_exists($folder.$model->student_image)) unlink($folder.$model->student_image);
		
		$model->student_image=$fileName;
		
		$model->save();
		}
		echo $return;// it's array
	}

	/**
	 * Manages all models.
	 */
	public function actionManage()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		
		else if(Yii::app()->request->getParam('export')) {
			$this->actionExport();
			Yii::app()->end();
		}
		
		$this->render('manage',array(
			'model'=>$model,
		));
	}

	public function actionCommunication()
	{
		$model=new Student('search2');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		
		else if(Yii::app()->request->getParam('export')) {
			$this->actionExport();
			Yii::app()->end();
		}
		
		$this->render('communication',array(
			'model'=>$model,
		));
	}
	
	 public function actionExport()
	{
		
                
        $model=new Student('search2');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];
			
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search2(),
                'grid_mode'=>'export',
				'columns'=>array(

			'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		
		'student_name',
		'student_email',
		'student_contact',
		'student_present_address',
		'student_permanent_address',
		'student_blood_group',

		//array('name'=>'student_image','value'=>'CHtml::image( $data->getStImage($data->student_image),"",array(\'width\'=>30, \'height\'=>45))','type'=>'raw'),

		//array('name'=>'batch_ref_course_pk','value'=>'$data->EnrollmentInfo->course->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_name','course_name'),),

		//array('name'=>'department_id','value'=>'$data->EnrollmentInfo->department->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'department_name','department_name'),),

		//array('name'=>'student_ref_batch_pk','value'=>'$data->EnrollmentInfo->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),

		//array('name'=>'EnrollmentInfo.semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->EnrollmentInfo->course_id,$data->EnrollmentInfo->semester)','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),

		//array('name'=>'semester','value'=>'$data->EnrollmentInfo->semesterLevel->lebel','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel'),),



//'student_father_name',
		//'student_mother_name',
		//'student_present_address',
		//'student_permanent_address',
		//'student_nationality',
		//'student_gender',
		//'student_dob',
		//'student_pob',
		//'student_profession',
		//'student_email',
		//'student_fb_id',
		//'student_contact',
		//'student_blood_group',
		//'student_qualification',
		//'student_alternate_contact',
		//'student_reason_of_photography',
		//'student_expectation',
		//'student_pk',
		array(
			'class'=>'CButtonColumn',
		),
	),
	

                'exportType'=>'Excel5',
                'filename'=>'Student',
                ));
                
                
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Student::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
