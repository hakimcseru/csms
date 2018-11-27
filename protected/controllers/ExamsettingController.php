<?php

class ExamsettingController extends Controller
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
	 
	 
	/*	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','session','course','disCoor'),
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
	
	public function actionSaveandLock()
	{
		
		
		
		if(isset($_POST))
			{
			 //print_r($_POST);
			 //die();
				$subjectse=Examsetting::model()->findAll("session='".$_POST['session_id']."' and course='".$_POST['course_id']."' and department='".$_POST['department_id']."' and batch_id='".$_POST['batch_id']."' and batch_group='".$_POST['batch_group_id']."' and semester='".$_POST['semester_id']."'");
				$sub_min_mark= array();
				$alreadygenerated=false;
				
				foreach($subjectse as $sub):
				$sub_min_mark[$sub->subject]="";
				if($sub->pass_mark>0)
				$sub_min_mark[$sub->subject]=$sub->pass_mark;
				else{
					$sub33=CourseSubject::model()->find("course_subject_ref_course_pk=".$_POST['course_id']." and course_subject_semester_no=".$_POST['semester_id']." and course_subject_department_id=".$_POST['department_id']." and course_subject_ref_subject_pk='".$sub->subject."' ");
					if(isset($sub33))
					$sub_min_mark[$sub->subject]=$sub33->pass_mark;
				}
				if($sub->lock=='Yes') $alreadygenerated=true;
				endforeach;
				
				$alreadygenerated=false; // bypass the above check;
				
				if($alreadygenerated==false)
				{
				
				foreach($_POST['roll_no'] as $key=>$value):
				
				$model= new SavedResult;
				$model->session_id=$_POST['session_id'];
				$model->batch_id=$_POST['batch_id'];
				$model->course_id=$_POST['course_id'];
				$model->course=$_POST['course'];
				$model->department_id=$_POST['department_id'];
				$model->department=$_POST['department'];
				$model->semester_id=$_POST['semester_id'];
				$model->semester=$_POST['semester'];
				$model->batch_group_id=$_POST['batch_group_id'];
				$model->batch_group=$_POST['batch_group'];
				
				
				$model->roll_no=$_POST['roll_no'][$key];
				$model->name=$_POST['name'][$key];
				$model->student_id=$_POST['student_id'][$key];
				
				$model->total_number=@$_POST['total_number'][$key];
				
				$model->result=@$_POST['result'][$key];
				$model->position=@$_POST['position'][$key];
				
				$model->published_date=@$_POST['published_date'];
				$model->saved_date=date("Y-m-d");
				$model->saved_by=Yii::app()->user->id;
				
				
				
				
				if($model->save())
				{
				 
					foreach($_POST['subject_id'] as $key=>$subject_id):
					$model2=new SavedResultSubject;
					$model2->saved_result_id=$model->id;
					$model2->subject_min_mark=$sub_min_mark[$subject_id];
					$model2->subject_id=$subject_id;
					$model2->subject_code=$_POST['subject_code'][$key];
					$model2->subject_name=$_POST['subject_name'][$key];
					$model2->subject_full_mark=$_POST['subject_full_mark'][$key];
					$model2->student_subject_marks=$_POST['student_subject_marks'.$model->student_id][$key];
					$model2->save();
					
					
					
					endforeach;
				}
				
				endforeach;
				foreach($subjectse as $sub):
				$sub->lock='Yes'; $sub->save();
				endforeach;
				
				echo 'Save Successfully. Please <a href="'.Yii::app()->createUrl('examsetting/tabulation').'">go back</a>';
				
				} else echo "Already Generated";
			}
	}
	
	public function actionTabulation($id="")
	
	{
	
	
		$model=new Examsetting;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Examsetting']))
		{
			if(isset($_POST['yt0']))
			{
			$model->attributes=$_POST['Examsetting'];
			$subjectse=Examsetting::model()->findAll("session='".$model->session."' and course='".$model->course."' and department='".$model->department."' and batch_id='".$model->batch_id."' and batch_group='".$model->batch_group."' and semester='".$model->semester."'");
			
			foreach($subjectse as $sub2): 
					
					$sub=CourseSubject::model()->find("course_subject_ref_course_pk=".$sub2->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$sub2->department." and course_subject_ref_subject_pk='".$sub2->subject."' ");
					$ssuubb[]=$sub->subject->subject_pk;
			endforeach;	
			
			$allsub=@implode(",",$ssuubb);
			$connection=Yii::app()->db;
			if(isset($allsub))
			{
			$command=$connection->createCommand("SELECT distinct(student_pk),sum(full_marks) FROM student_result where
				session='".$model->session."' and
				course='".$model->course."' and
				department='".$model->department."' and
				semester='".$model->semester."' and
				batch_id='".$model->batch_id."' and
				batch_group='".$model->batch_group."' and
				subject in ( $allsub )
				group by student_pk
				order by sum(full_marks) DESC
				");}
				else $command=$connection->createCommand("SELECT distinct(student_pk),sum(full_marks) FROM student_result where
				session='".$model->session."' and
				course='".$model->course."' and
				department='".$model->department."' and
				semester='".$model->semester."' and
				batch_id='".$model->batch_id."' and
				batch_group='".$model->batch_group."' and
								group by student_pk
				order by sum(full_marks) DESC
				");
			$model2 = $command->queryAll();
	
			
		
		
			$this->render('tabulation',array(
			'model'=>$model,'model2'=>$model2,'subjectse'=>$subjectse,'batch_id'=>$model->batch_id,
		));
		}
		elseif(isset($_POST['yt1']))
		{
			//layout
			$this->layout = 'print';
			$model->attributes=$_POST['Examsetting'];
			$subjectse=Examsetting::model()->findAll("session='".$model->session."' and course='".$model->course."' and department='".$model->department."' and batch_id='".$model->batch_id."' and batch_group='".$model->batch_group."' and semester='".$model->semester."'");
			
			foreach($subjectse as $sub2): 
					
					$sub=CourseSubject::model()->find("course_subject_ref_course_pk=".$sub2->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$sub2->department." and course_subject_ref_subject_pk='".$sub2->subject."' ");
					$ssuubb[]=$sub->subject->subject_pk;
			endforeach;	
			
			$allsub=implode(",",$ssuubb);
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(student_pk),sum(full_marks) FROM student_result where
				session='".$model->session."' and
				course='".$model->course."' and
				department='".$model->department."' and
				semester='".$model->semester."' and
				batch_id='".$model->batch_id."' and
				batch_group='".$model->batch_group."' and
				subject in ( $allsub )
				group by student_pk
				order by sum(full_marks) DESC
				");
			$model2 = $command->queryAll();
		
		
			$this->render('tabulation',array(
			'model'=>$model,'model2'=>$model2,'subjectse'=>$subjectse,'batch_id'=>$model->batch_id,
		));
			
		}
		
		elseif(isset($_POST['yt2']))
		{
			$model->attributes=$_POST['Examsetting'];
			//echo "xczxczxc"
			$this->redirect(array('savedResult/marksheet', 'session'=>$model->session,'course'=>$model->course, 'department'=>$model->department,'semester'=>$model->semester, 'batch_id'=>$model->batch_id, 'batch_group'=>$model->batch_group));
				
		}
		
		
		
		}

		else $this->render('tabulation',array(
			'model'=>$model,
		));
	}
		
	public function actionAdd($id)
	{
	$model=$this->loadModel($id);
	
	
	
	if(isset($_POST['yt0']))
			{
			$subject_e=CourseSubject::model()->find("course_subject_ref_course_pk=".$model->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$model->department." and course_subject_ref_subject_pk='".$model->subject."' ");	
				
				$full_marks_a=$model->full_mark;
				
				if($full_marks_a<=0) 
						if($subject_e->full_mark) $full_marks_a=$subject_e->full_mark;
					
	//echo $model->mark_type;
				if($full_marks_a>0 || $model->mark_type=="Grading")  // no operation
				{
					
			$students=StudentEnrollmentInfo::model()->findAll("course_id=".$model->course." and semester=".$model->semester." and department_id=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group);
foreach($students as $student):	
			if(isset($_POST[$student->student_id.'_marks']))
			
			{
				//ExamMarks::model()->deleteAll('examseting_id='.$model->id);
				//StudentResult::model()->deleteAll('examseting_id='.$model->id);
				$tss=$_POST[$student->student_id.'_marks'];
				//print_r($tss); die();
				
				if(isset($tss))
				{
				$st=0;
				$i=0;
				$stmarks=0;
				$ansent=0;
				foreach($tss as $ts ):
				if($ts)
					{
					$st=1;
					
					
					StudentResult::model()->deleteAll("course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and student_id='".$student->student_id."' and subject='".$model->subject."'");
					

					ExamMarks::model()->deleteAll("course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and teacher_id='".$_POST[$student->student_id.'_ts'][$i]."' and student_id='".$student->student_id."' and subject='".$model->subject."'");			
					
				
					
					
					$mod=new ExamMarks;
					$mod->examseting_id=$model->id;
					
					$mod->marks=$ts; 
					$mod->teacher_id=$_POST[$student->student_id.'_ts'][$i]; 
					$mod->course=$model->course; 
					$mod->semester=$model->semester; 
					$mod->department=$model->department; 
					$mod->session=$model->session; 
					$mod->student_pk=$student->student_pk; 
					$mod->student_id=$student->student_id;  
					$mod->subject=$model->subject; 
					$mod->batch_id=$model->batch_id; 
					$mod->batch_group=$model->batch_group; 
					$mod->save();
					
					
					if($ts=='অ') {$ts=0; $ansent=1;}
					$stmarks=$stmarks+$ts;
					$mar=$ts;
							
					
					}
					$i++;
				endforeach;
				
				if($st)
				{
				//echo $i;
				
				
						
				
				
				
				if($model->mark_type=="Average") $tm=$stmarks/($i);
				elseif($model->mark_type=="Sum") $tm=$stmarks;
				elseif($model->mark_type=="Grading") $tm=$mar;
				else $tm=0;
				
				if($model->mark_type=="Grading") 
					$tm1=$mar;
				else
				$tm1=($tm/$full_marks_a)*100;
				
				//echo $tm; die();
				$mods=new StudentResult;
				$mods->examseting_id=$model->id;
				$mods->course=$model->course; 
				$mods->semester=$model->semester; 
				$mods->department=$model->department; 
				$mods->session=$model->session; 
				$mods->subject=$model->subject; 
				$mods->student_pk=$student->student_pk; 
				$mods->student_id=$student->student_id;  
				$mods->batch_id=$model->batch_id; 
				$mods->batch_group=$model->batch_group; 
				$mods->full_marks=$tm;
				
				if($ansent)
				{
					$mods->result='অ';
					$mods->full_marks='অ';
				}
				else{
				$mods->full_marks=$tm;
				$res=ResultSetings::model()->find("session='".$model->session."' and	'".$tm1."'>=start_limit and '".$tm1."'<=end_limit");
				
				if($model->mark_type=="Grading") 
				$mods->result=$stmarks;
				
				elseif($res)
				$mods->result=$res->result;
				}
				
				//$mods->batch_group=$model->batch_group; 
				
				$mods->save();
				
				}
				}
				
			}
			
				endforeach;
			}
		else echo "Please input full marks";
			
			}
	
		$this->render('add_marks',array(
			'model'=>$this->loadModel($id),
		));
		
	}	
	
	
	public function actionViewMarks($id)
	{
	$model=$this->loadModel($id);
	if(isset($_POST['yt0']))
			{
			
			$students=StudentEnrollmentInfo::model()->findAll("course_id=".$model->course." and semester=".$model->semester." and department_id=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group);
foreach($students as $student):	
			if(isset($_POST[$student->student_id.'_marks']))
			
			{
				//ExamMarks::model()->deleteAll('examseting_id='.$model->id);
				//StudentResult::model()->deleteAll('examseting_id='.$model->id);
				$tss=$_POST[$student->student_id.'_marks'];
				//print_r($tss); die();
				
				if(isset($tss))
				{
				$st=0;
				$i=0;
				$stmarks=0;
				$ansent=0;
				foreach($tss as $ts ):
				if($ts)
					{
					$st=1;
					
					
					StudentResult::model()->deleteAll("course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and student_id='".$student->student_id."' and subject='".$model->subject."'");
					

					ExamMarks::model()->deleteAll("course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and teacher_id='".$_POST[$student->student_id.'_ts'][$i]."' and student_id='".$student->student_id."' and subject='".$model->subject."'");			
					
				
					
					
					$mod=new ExamMarks;
					$mod->examseting_id=$model->id;
					
					$mod->marks=$ts; 
					$mod->teacher_id=$_POST[$student->student_id.'_ts'][$i]; 
					$mod->course=$model->course; 
					$mod->semester=$model->semester; 
					$mod->department=$model->department; 
					$mod->session=$model->session; 
					$mod->student_pk=$student->student_pk; 
					$mod->student_id=$student->student_id;  
					$mod->subject=$model->subject; 
					$mod->batch_id=$model->batch_id; 
					$mod->batch_group=$model->batch_group; 
					$mod->save();
					
					
					if($ts=='অ') {$ts=0; $ansent=1;}
					$stmarks=$stmarks+$ts;
					$mar=$ts;
							
					
					}
					$i++;
				endforeach;
				
				if($st)
				{
				//echo $i;
				
				$subject_e=CourseSubject::model()->find("course_subject_ref_course_pk=".$model->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$model->department." and course_subject_ref_subject_pk='".$model->subject."' ");	
				
				echo $model->mark_type;
				if($model->mark_type=="Average") $tm=$stmarks/($i);
				elseif($model->mark_type=="Sum") $tm=$stmarks;
				elseif($model->mark_type=="Grading") $tm=$mar;
				else $tm=0;
				
				
				$tm1=($tm/$subject_e->full_mark)*100;
				
				//echo $tm; die();
				$mods=new StudentResult;
				$mods->examseting_id=$model->id;
				$mods->course=$model->course; 
				$mods->semester=$model->semester; 
				$mods->department=$model->department; 
				$mods->session=$model->session; 
				$mods->subject=$model->subject; 
				$mods->student_pk=$student->student_pk; 
				$mods->student_id=$student->student_id;  
				$mods->batch_id=$model->batch_id; 
				$mods->batch_group=$model->batch_group; 
				$mods->full_marks=$tm;
				
				if($ansent)
				{
					$mods->result='অ';
					$mods->full_marks='অ';
				}
				else{
				$mods->full_marks=$tm;
				$res=ResultSetings::model()->find("session='".$model->session."' and	'".$tm1."'>=start_limit and '".$tm1."'<=end_limit");
				
				if($model->mark_type=="Grading") 
				$mods->result=$stmarks;
				
				elseif($res)
				$mods->result=$res->result;
				}
				
				//$mods->batch_group=$model->batch_group; 
				
				$mods->save();
				}
				}
				
			}
			
				endforeach;
				
			}
	
		$this->render('view_marks',array(
			'model'=>$this->loadModel($id),
		));
	}
	

	public function actionPrintMarks($id)
	{
	$model=$this->loadModel($id);
	if(isset($_POST['yt0']))
			{
			
			$students=StudentEnrollmentInfo::model()->findAll("course_id=".$model->course." and semester=".$model->semester." and department_id=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group);
foreach($students as $student):	
			if(isset($_POST[$student->student_id.'_marks']))
			
			{
				//ExamMarks::model()->deleteAll('examseting_id='.$model->id);
				//StudentResult::model()->deleteAll('examseting_id='.$model->id);
				$tss=$_POST[$student->student_id.'_marks'];
				//print_r($tss); die();
				
				if(isset($tss))
				{
				$st=0;
				$i=0;
				$stmarks=0;
				$ansent=0;
				foreach($tss as $ts ):
				if($ts)
					{
					$st=1;
					
					
					StudentResult::model()->deleteAll("course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and student_id='".$student->student_id."' and subject='".$model->subject."'");
					

					ExamMarks::model()->deleteAll("course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and teacher_id='".$_POST[$student->student_id.'_ts'][$i]."' and student_id='".$student->student_id."' and subject='".$model->subject."'");			
					
				
					
					
					$mod=new ExamMarks;
					$mod->examseting_id=$model->id;
					
					$mod->marks=$ts; 
					$mod->teacher_id=$_POST[$student->student_id.'_ts'][$i]; 
					$mod->course=$model->course; 
					$mod->semester=$model->semester; 
					$mod->department=$model->department; 
					$mod->session=$model->session; 
					$mod->student_pk=$student->student_pk; 
					$mod->student_id=$student->student_id;  
					$mod->subject=$model->subject; 
					$mod->batch_id=$model->batch_id; 
					$mod->batch_group=$model->batch_group; 
					$mod->save();
					
					
					if($ts=='অ') {$ts=0; $ansent=1;}
					$stmarks=$stmarks+$ts;
					$mar=$ts;
							
					
					}
					$i++;
				endforeach;
				
				if($st)
				{
				//echo $i;
				
				$subject_e=CourseSubject::model()->find("course_subject_ref_course_pk=".$model->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$model->department." and course_subject_ref_subject_pk='".$model->subject."' ");	
				
				echo $model->mark_type;
				if($model->mark_type=="Average") $tm=$stmarks/($i);
				elseif($model->mark_type=="Sum") $tm=$stmarks;
				elseif($model->mark_type=="Grading") $tm=$mar;
				else $tm=0;
				
				
				$tm1=($tm/$subject_e->full_mark)*100;
				
				//echo $tm; die();
				$mods=new StudentResult;
				$mods->examseting_id=$model->id;
				$mods->course=$model->course; 
				$mods->semester=$model->semester; 
				$mods->department=$model->department; 
				$mods->session=$model->session; 
				$mods->subject=$model->subject; 
				$mods->student_pk=$student->student_pk; 
				$mods->student_id=$student->student_id;  
				$mods->batch_id=$model->batch_id; 
				$mods->batch_group=$model->batch_group; 
				$mods->full_marks=$tm;
				
				if($ansent)
				{
					$mods->result='অ';
					$mods->full_marks='অ';
				}
				else{
				$mods->full_marks=$tm;
				$res=ResultSetings::model()->find("session='".$model->session."' and	'".$tm1."'>=start_limit and '".$tm1."'<=end_limit");
				
				if($model->mark_type=="Grading") 
				$mods->result=$stmarks;
				
				elseif($res)
				$mods->result=$res->result;
				}
				
				//$mods->batch_group=$model->batch_group; 
				
				$mods->save();
				}
				}
				
			}
			
				endforeach;
				
			}
		$this->layout = 'print';
		$this->render('print_marks',array(
			'model'=>$this->loadModel($id),
		));
	}	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Examsetting;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Examsetting']))
		{
			$model->attributes=$_POST['Examsetting'];
			//print_r($_POST['Examsetting']['teacher']); die();
			
			if($model->save())
			
			{ 
			if(isset($_POST['Examsetting']['teacher']))
			{
				$tss=$_POST['Examsetting']['teacher'];
				
				foreach($tss as $ts):
				$mod=new ExamsettingFacultymember;
				$mod->examsetting_id=$model->id;
				$mod->faculty_member_id=$ts;
				$mod->save();
				endforeach;
				
			}
			
			} 
			
			
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Examsetting']))
		{
			$model->attributes=$_POST['Examsetting'];
			if($model->save())
			{
					/*if(isset($_POST['Examsetting']['teacher']))
					
					{
					ExamsettingFacultymember::model()->deleteAll("examsetting_id=".$id);
					
					
						$tss=$_POST['Examsetting']['teacher'];
						
						foreach($tss as $ts):
						$mod=new ExamsettingFacultymember;
						$mod->examsetting_id=$model->id;
						$mod->faculty_member_id=$ts;
						$mod->save();
						endforeach;
						
					}*/
					
			}
			
				$this->redirect(array('admin','id'=>$model->id));
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
			$model=$this->loadModel($id);
			if($model->delete())
			{
			ExamsettingFacultymember::model()->deleteAll("examsetting_id=".$id);
			
			}
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
		$dataProvider=new CActiveDataProvider('Examsetting');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Examsetting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Examsetting']))
			$model->attributes=$_GET['Examsetting'];

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
		        
        $model=new Examsetting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Examsetting']))
			$model->attributes=$_GET['Examsetting'];
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns'=>array(
		'id',
		'session',
		//'course',
		array(
			'name'=>'course',
		'value'=>'$data->coursec?$data->coursec->course_name:""',
		
		),
		//'department',
		array(
			'name'=>'department',
		'value'=>'$data->departments?$data->departments->department_name:""',
		
		),
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id')),
		'batch_group'=>array('type'=>'raw','name'=>'batch_group','value'=>'$data->batchgroup->group_name." (". $data->batchgroup->id .")"','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		//'subject',
		array(
			'name'=>'subject',
		'value'=>'$data->subjects?$data->subjects->subject_name:""',
		
		),
		
		
		'semester'=>array('name'=>'semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course,$data->semester,1)','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel')),

		
		
		'mark_type',
		array(
			'header'=>'Teacher',
			'value'=>'$data->allteacher($data)',
		
		),
	
		//'semester',
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}{update}{delete}{add}{tabulation}',
            'buttons'=>array
            (
                
               
			   
			 'add' => array
                (
                    'label'=>'Add Marks',
                    'icon'=>'plus',
                    'url'=>'Yii::app()->createUrl("examsetting/add", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-info',
                    ),
                ),
				
				'tabulation' => array
                (
                    'label'=>'Tabulation',
                    //'icon'=>'plus',
                    'url'=>'Yii::app()->createUrl("examsetting/tabulation", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-info',
                    ),
                ),
			
			),
		),
	),
	
			 'exportType'=>'Excel5',
			 'filename'=>'examsetting',
                ));
                
                
	}
	
	
	public function loadModel($id)
	{
		$model=Examsetting::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='examsetting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSession() {
				$model = Course::model()->findAll();
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($model as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->course_pk),CHtml::encode($mod->course_name),true);
				}
		}
	
		public function actionCourse() {
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['Examsetting']['course']);
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
		
      public function actionDisCoor() {
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['Examsetting']['course']);
                 $data=CHtml::listData($model,'batch_pk','batch_id');
				
				echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
							   
				foreach($data as $value=>$name)
				{
					echo CHtml::tag('option',
							   array('value'=>$value),CHtml::encode($name),true);
				}
		}
	 public function actionGroup() {
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['Examsetting']['batch_id']);
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
  	
	public function actionSemester() {
	
				//echo $_POST['CourseSemesterLebel']['course_id'];
				
				$cou = Course::model()->findByPk($_POST['Examsetting']['course']);
				
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				if($cou->semester)
				{
				
				for($i=0;$i<=$cou->semester;$i++)
				{
				if($i==0)
				echo CHtml::tag('option',
							   array('value'=>''),'Pleae Select',true);
				else
				{
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$_POST['Examsetting']['course']." and semester_id=".$i);
					echo CHtml::tag('option',
							   array('value'=>$i),$clebel->lebel,true);
				}
				}
				}
				
		}
  
  

  
	
	public function actionSubject() {
				//$models = CourseSubject::model()->findAll("course_subject_ref_course_pk=".$_POST['Examsetting']['course']." and course_subject_department_id=".$_POST['Examsetting']['department']);
               
				//print_r($models); die();
				$courseSubject = new CourseSubject('search');
			$courseSubject->unsetAttributes();  // clear any default values
			$courseSubject->course_subject_ref_course_pk = $_POST['Examsetting']['course'];
			$courseSubject->course_subject_department_id = $_POST['Examsetting']['department'];
			$courseSubject->course_subject_semester_no = $_POST['Examsetting']['semester'];
			
			$models=$courseSubject->search()->getData();
			//$models=getData($mod);
				//print_r($models);  die();
				
				echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
							   
				foreach($models as $modd)
				{
				//echo $value->course_subject_pk ; die();
					echo CHtml::tag('option',
							   array('value'=>$modd->course_subject_ref_subject_pk),CHtml::encode($modd->subject->subject_name),true);
				}
	}
	
}
