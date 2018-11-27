<?php

class ClassRoutineController extends Controller
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
	public function actionCreate($session_id,$room_id,$class_period_id,$weekday,$calendar_id)
	{
		$model=new ClassRoutine;
		$model->session_id=$session_id;
		$model->room_id=$room_id;
		$model->class_period_id=$class_period_id;
		$model->weekday=$weekday;
		$model->calendar_id=$calendar_id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassRoutine']))
		{
			$model->attributes=$_POST['ClassRoutine'];
			
			$error=0;
			
			$cr=ClassRoutine::model()->find("
			(faculty_member_id='".$_POST['ClassRoutine']['faculty_member_id']."' 
			or additional_faculty_member_id='".$_POST['ClassRoutine']['faculty_member_id']."' 
			or faculty_member_id='".$_POST['ClassRoutine']['additional_faculty_member_id']."' 
			or additional_faculty_member_id='".$_POST['ClassRoutine']['additional_faculty_member_id']."') 
			and class_period_id='".$_POST['ClassRoutine']['class_period_id']."' and session_id='".$_POST['ClassRoutine']['session_id']."' and calendar_id='".$model->calendar_id."'
			and weekday='".$model->weekday."'");
			
			if($cr)
			{
				$aff=$cr->A_facultyMember?$cr->A_facultyMember->member_name:"";
				if($cr->room_id!=$_POST['ClassRoutine']['room_id'])				
				$error=1;
			}
			
			if($error)
			{
			
			$fm=FacultyMember::model()->findByPk($_POST['ClassRoutine']['faculty_member_id'])->member_name;
			$afm=FacultyMember::model()->findByPk($_POST['ClassRoutine']['additional_faculty_member_id'])->member_name;
			
				Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> It conflict with: <br /> '.$cr->facultyMember->member_name .'->'.$fm.' 
			<br />'.$aff.
			' -> '.$afm.', <br/> Please check.');
				//echo "It matched with";
			}
			else{
			
			if($model->save())
			{
				
				
				//$this->redirect(array('manage','id'=>$model->id));
				$this->redirect(array('manage','calendarinfo_id'=>$model->calendar_id,'weekday'=>$model->weekday));
				
			}
			}
		}
		
		

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	public function actionStudentAttendance()
	{
		$model=new ClassRoutine;
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassRoutine']))
		{
			$model->attributes=$_POST['ClassRoutine'];
			
			$model->course_id=$_POST['ClassRoutine']['course_id'];
			$model->semester_id=$_POST['ClassRoutine']['semester_id'];
			$model->batch_group_id=$_POST['ClassRoutine']['batch_group_id'];
			$model->batch_id=$_POST['ClassRoutine']['batch_id'];
			$model->department_id=$_POST['ClassRoutine']['department_id'];
			$model->range=$_POST['ClassRoutine']['range'];
		
			if(isset($_POST['yt1']))
			{
			$this->layout="print";
			$this->render('printst',array(
			'model'=>$model,
				));}
			else{	$this->render('studentattendance2',array(
			'model'=>$model,
			));}
			
			
			
			
			
			
		}
		
		else{

		$this->render('studentAttendance',array(
			'model'=>$model,
		));
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

		if(isset($_POST['ClassRoutine']))
		{
			$model->attributes=$_POST['ClassRoutine'];
			$error=0;
			
			$cr=ClassRoutine::model()->find("
			(faculty_member_id='".$_POST['ClassRoutine']['faculty_member_id']."' 
			or additional_faculty_member_id='".$_POST['ClassRoutine']['faculty_member_id']."' 
			or faculty_member_id='".$_POST['ClassRoutine']['additional_faculty_member_id']."' 
			or additional_faculty_member_id='".$_POST['ClassRoutine']['additional_faculty_member_id']."') 
			and class_period_id='".$_POST['ClassRoutine']['class_period_id']."' and session_id='".$_POST['ClassRoutine']['session_id']."' and calendar_id='".$model->calendar_id."'
			and weekday='".$model->weekday."'");
			
			if($cr)
			{
				if($cr->room_id!=$_POST['ClassRoutine']['room_id'])				
				$error=1;
			}
			
			if($error)
			{
			$aff=$cr->A_facultyMember?$cr->A_facultyMember->member_name:"";
			$fm=FacultyMember::model()->findByPk($_POST['ClassRoutine']['faculty_member_id'])->member_name;
			$afm=FacultyMember::model()->findByPk($_POST['ClassRoutine']['additional_faculty_member_id'])->member_name;
			
				Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> It conflict with: <br /> '.$cr->facultyMember->member_name .'->'.$fm.' 
			<br />'.$aff.' -> '.$afm.', <br/> Please check.');
				//echo "It matched with";
			}
			else{
			if($model->save())
				$this->redirect(array('manage','calendarinfo_id'=>$model->calendar_id,'weekday'=>$model->weekday));
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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			/*if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
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
		$model=new CalendarInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CalendarInfo']))
		{
			if(isset($_POST['yt0']))
			{
			
				$this->redirect(array('manage','calendarinfo_id'=>$_POST['CalendarInfo']['calendar_name'],'weekday'=>$_POST['CalendarInfo']['weekday']));
			}
			if(isset($_POST['yt1']))
			{
				$this->redirect(array('manage2','calendarinfo_id'=>$_POST['CalendarInfo']['calendar_name'],'weekday'=>$_POST['CalendarInfo']['weekday']));
			}
			if(isset($_POST['yt2']))
			{
				$this->redirect(array('manage3','calendarinfo_id'=>$_POST['CalendarInfo']['calendar_name'],'weekday'=>$_POST['CalendarInfo']['weekday']));
			}
		
		} else {

		$this->render('index',array(
			'model'=>$model,
		));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ClassRoutine('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassRoutine']))
			$model->attributes=$_GET['ClassRoutine'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionManage($calendarinfo_id,$weekday)
	{
		$model=CalendarInfo::model()->findByPk($calendarinfo_id);
		
		$room=Room::model()->findAll();
		$period=ClassPeriod::model()->findAll("week_day='".$weekday."'");
		
		$model3=new ClassRoutine('search');
		//$model3->calendar_id=$calendarinfo_id;
		$model3->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassRoutine']))
			$model3->attributes=$_GET['ClassRoutine'];
			
		$model2=new ClassRoutine;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassRoutine']))
		{
			$model2->attributes=$_POST['ClassRoutine'];
			if($model2->save())
			{
				 if(Yii::app()->request->isAjaxRequest)
                {

                    echo CJSON::encode(array(
                        'status'=>'success',
                        'div'=>"Successfully Added.."
                    ));
                    exit;
                }
				
				//$this->redirect(array('view','id'=>$model->id));
				
			}
		}
		
		
		$this->render('manage',array('model3'=>$model3,'model2'=>$model2,'model'=>$model,'weekday'=>$weekday,'period'=>$period,'room'=>$room));
	}
	
	
	public function actionManage2($calendarinfo_id,$weekday)
	{
		$model=CalendarInfo::model()->findByPk($calendarinfo_id);
		
		$room=Room::model()->findAll();
		$period=ClassPeriod::model()->findAll("week_day='".$weekday."'");
		
		$model3=new ClassRoutine('search');
		//$model3->calendar_id=$calendarinfo_id;
		$model3->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassRoutine']))
			$model3->attributes=$_GET['ClassRoutine'];
			
		$model2=new ClassRoutine;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassRoutine']))
		{
			$model2->attributes=$_POST['ClassRoutine'];
			if($model2->save())
			{
				 if(Yii::app()->request->isAjaxRequest)
                {

                    echo CJSON::encode(array(
                        'status'=>'success',
                        'div'=>"Successfully Added.."
                    ));
                    exit;
                }
				
				//$this->redirect(array('view','id'=>$model->id));
				
			}
		}
		
		
		$this->render('manage2',array('model3'=>$model3,'model2'=>$model2,'model'=>$model,'weekday'=>$weekday,'period'=>$period,'room'=>$room));
	}


public function actionManage3($calendarinfo_id,$weekday)
	{
		$model=CalendarInfo::model()->findByPk($calendarinfo_id);
		
		$room=Room::model()->findAll();
		$period=ClassPeriod::model()->findAll("week_day='".$weekday."'");
		
		$model3=new ClassRoutine('search');
		//$model3->calendar_id=$calendarinfo_id;
		$model3->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassRoutine']))
			$model3->attributes=$_GET['ClassRoutine'];
			
		$model2=new ClassRoutine;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassRoutine']))
		{
			$model2->attributes=$_POST['ClassRoutine'];
			if($model2->save())
			{
				 if(Yii::app()->request->isAjaxRequest)
                {

                    echo CJSON::encode(array(
                        'status'=>'success',
                        'div'=>"Successfully Added.."
                    ));
                    exit;
                }
				
				//$this->redirect(array('view','id'=>$model->id));
				
			}
		}
		
		
		$this->render('manage3',array('model3'=>$model3,'model2'=>$model2,'model'=>$model,'weekday'=>$weekday,'period'=>$period,'room'=>$room));
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
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['ClassRoutine']['course_id']);
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
  
  public function actionGetSemester() {
  
				$course=Course::model()->findByPk($_POST['ClassRoutine']['course_id']);
				//echo $course->semester; die();
				$semester=$course->allSemisterLebelsArray($_POST['ClassRoutine']['course_id'],$course->semester);
				
				//$model = CourseDepartment::model()->findAll("course_id=".$_POST['ClassRoutine']['course_id']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($semester as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->semester_id),CHtml::encode($mod->lebel),true);
				}
  }
  
  
  
  
  public function actionGetSubject() {
  
				
				$subject=CourseSubject::model()->findAll("course_subject_ref_course_pk=".$_POST['ClassRoutine']['course_id']." and course_subject_semester_no=".$_POST['ClassRoutine']['semester_id']." and course_subject_department_id=".$_POST['ClassRoutine']['department_id']);
				
				//$course=Course::model()->findByPk($_POST['ClassRoutine']['course_id']);
				//echo $course->semester; die();
				//$semester=$course->allSemisterLebelsArray($_POST['ClassRoutine']['course_id'],$course->semester);
				
				//$model = CourseDepartment::model()->findAll("course_id=".$_POST['ClassRoutine']['course_id']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($subject as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->course_subject_ref_subject_pk),CHtml::encode($mod->subject->subject_name),true);
				}
  }
		
public function actionDisCoor() {
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['ClassRoutine']['course_id']);
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
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['ClassRoutine']['batch_id']);
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
  
  
   public function actionBatchSection() {
   
				echo "batch_group_id=".$_POST['ClassRoutine']['batch_group_id'];
				$model = BatchSection::model()->findAll("batch_group_id=".$_POST['ClassRoutine']['batch_group_id']." and session_id=".$_POST['ClassRoutine']['session_id']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($model as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->id),CHtml::encode($mod->section_name),true);
				}
  }
	
	///////////////////only for print start

public function actionDisCoor2() {
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
	
	
	
	public function actionCemester2() {
	
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
	
	public function actionCourse2() {
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
  
  public function actionGroup2() {
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
 

//////////////////end print	


		public function actionPrint()
	{
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			
			
			$card_type=$_POST['Student']['card_type'];
			
			
			/*
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {if($where) $where .=" and batch_group =".$batch_group; else $where.=" batch_group =".$batch_group;}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {if($where) $where .=" and semester =".$semester; else $where.=" semester =".$semester;}
			*/
			
			if($card_type=="student-1")
			{
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;}
			
			$studentEnInfo=ClassRoutine::model()->findAll($where);
			$calendar_info=CalendarInfo::model()->findByPk($cname);
			
			
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where ORDER BY class_period.start_time asc");
			$cperiod = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();
			
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'model'=>$studentEnInfo,'cperiod'=>$cperiod,'section'=>$section,'where'=>$where,
				'course_name'=>$course_name,'department_name'=>$department_name,'batch_name'=>$batch_name,
				'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,
			));
			
			}
			elseif($card_type=="student-2")
			{
			
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			//if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
			}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;}
			
			$studentEnInfo=ClassRoutine::model()->findAll($where);
			$calendar_info=CalendarInfo::model()->findByPk($cname);
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by weekday");
			$cgroup = $command->queryAll();
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine where $where order by id");
			$cperiod = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();
			*/
			
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'model'=>$studentEnInfo,'where'=>$where,'cgroup'=>$cgroup,
				'course_name'=>$course_name,'department_name'=>$department_name,'batch_name'=>$batch_name,
				'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,
			));
			
			}
			elseif($card_type=="student-3")
			{
			
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
			}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;}
			
			$studentEnInfo=ClassRoutine::model()->findAll($where);
			$calendar_info=CalendarInfo::model()->findByPk($cname);
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by weekday");
			$cgroup = $command->queryAll();
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine where $where order by id");
			$cperiod = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();
			*/
			
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'model'=>$studentEnInfo,'where'=>$where,'cgroup'=>$cgroup,
				'course_name'=>$course_name,'department_name'=>$department_name,'batch_name'=>$batch_name,
				'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,
			));
			
			}
			elseif($card_type=="student-4")
			{
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;}
			
			$studentEnInfo=ClassRoutine::model()->findAll($where);
			$calendar_info=CalendarInfo::model()->findByPk($cname);
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where ORDER BY class_period.start_time asc");
			$cperiod = $command->queryAll();
			
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by batch_section_id");
			$weekdayw = $command->queryRow();
			//print_r($weekdayw); die();
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'model'=>$studentEnInfo,'cperiod'=>$cperiod,'section'=>$section,'where'=>$where,
				'course_name'=>$course_name,'department_name'=>$department_name,'batch_name'=>$batch_name,
				'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,'weekdayw'=>$weekdayw,
			));
			
			}
			elseif($card_type=="student-5")
			{
			
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			//if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
			}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;}
			
			$studentEnInfo=ClassRoutine::model()->findAll($where);
			$calendar_info=CalendarInfo::model()->findByPk($cname);
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by weekday");
			$cgroup = $command->queryAll();
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine where $where order by id");
			$cperiod = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();
			*/
			
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'model'=>$studentEnInfo,'where'=>$where,'cgroup'=>$cgroup,
				'course_name'=>$course_name,'department_name'=>$department_name,'batch_name'=>$batch_name,
				'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,
			));
			
			}
			elseif($card_type=="student-6")
			{
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			//if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;
			}
			
			$studentEnInfo=ClassRoutine::model()->findAll($where);
			$calendar_info=CalendarInfo::model()->findByPk($cname);
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where ORDER BY class_period.start_time asc");
			$cperiod = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by batch_section_id");
			$weekdayw = $command->queryRow();
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'model'=>$studentEnInfo,'cperiod'=>$cperiod,'section'=>$section,'where'=>$where,
				'course_name'=>$course_name,'department_name'=>$department_name,'batch_name'=>$batch_name,
				'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,'weekdayw'=>$weekdayw,
			));
			
			}
			elseif($card_type=="teacher")
			{
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			//if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;
			}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			//if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;
			}
			
			
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			//if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;
			}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;
			
			}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			//if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
			}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			//if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;
			}
			
			
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(faculty_member_id) FROM class_routine where $where order by faculty_member_id");
			$fmember = $command->queryAll();
			
			//$studentEnInfo=ClassRoutine::model()->findAll($where);
			//$calendar_info=CalendarInfo::model()->findByPk($cname);
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine where $where order by id");
			$cperiod = $command->queryAll();*/
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();*/
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by batch_section_id");
			$weekdayw = $command->queryRow();*/
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'fmember'=>$fmember,'where'=>$where,
			));
			
			}
			elseif($card_type=="adteacher")
			{
			$where="";
			
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {
			$course_name=Course::model()->findByPk($course)->course_name;
			//if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
			}
			
			
			
			$cname=$_POST['Student']['calendar_name'];
			if($cname) {
			
			if($where) $where .=" and calendar_id =".$cname; else $where.=" calendar_id =".$cname;
			}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {
			$department_name=Department::model()->findByPk($department)->department_name;
			//if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;
			}
			
			
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {
			$batch_name=Batch::model()->findByPk($batch)->batch_id;
			//if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;
			}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;
			
			}
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {
			$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
			//if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
			}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {
			$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
			//if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;
			}
			
			
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(additional_faculty_member_id) FROM class_routine where $where order by faculty_member_id");
			$fmember = $command->queryAll();
			
			//$studentEnInfo=ClassRoutine::model()->findAll($where);
			//$calendar_info=CalendarInfo::model()->findByPk($cname);
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine where $where order by id");
			$cperiod = $command->queryAll();*/
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where order by batch_section_id");
			$section = $command->queryAll();*/
			
			/*
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where order by batch_section_id");
			$weekdayw = $command->queryRow();*/
				
				$this->layout='//layouts/'.$card_type;
				$this->renderPartial('_'.$card_type,array(
				'fmember'=>$fmember,'where'=>$where,
			));
			
			}
			//$roll_no_start=$_POST['Student']['roll_no_start'];
                        //$roll_no_end=$_POST['Student']['roll_no_end'];
			
			/*if($roll_no_start && $roll_no_end)
                        {
                            {if($where) $where .=" and ( roll_no >= $roll_no_start and roll_no <= $roll_no_end) "; else $where.=" ( roll_no >= $roll_no_start and roll_no <= $roll_no_end) ";}
                        }
                        
                        $where .=" order by roll_no ASC";*/
                        
			
		exit();
		/*
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->student_pk));
				*/
		}

		$this->render('print',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ClassRoutine::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='class-routine-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
