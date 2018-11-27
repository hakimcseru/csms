<?php

class ExamRoutineController extends Controller
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
	public function actionCreate()
	{
		$model=new ExamRoutine;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamRoutine']))
		{
			$model->attributes=$_POST['ExamRoutine'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['ExamRoutine']))
		{
			$model->attributes=$_POST['ExamRoutine'];
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
		$model=new ExamRoutine;
		if(isset($_POST['ExamRoutine']))
		{
			if(isset($_POST['yt0']))
			{
			
				$this->redirect(array('manage','id'=>$_POST['ExamRoutine']['name'],'session_id'=>$_POST['ExamRoutine']['session_id']));
			}
			elseif(isset($_POST['yt1']))
			{
				$this->redirect(array('manage2','id'=>$_POST['ExamRoutine']['name'],'session_id'=>$_POST['ExamRoutine']['session_id']));
			}
			elseif(isset($_POST['yt2']))
			{
				$this->redirect(array('manage3','id'=>$_POST['ExamRoutine']['name'],'session_id'=>$_POST['ExamRoutine']['session_id']));
			}
			elseif(isset($_POST['yt3']))
			{
				$this->redirect(array('manage4','id'=>$_POST['ExamRoutine']['name'],'session_id'=>$_POST['ExamRoutine']['session_id'],'date'=>$_POST['ExamRoutine']['date']));
			}
		}
		else{
		$this->render('index',array(
			'model'=>$model,
		));
		}
	}
	
	
	public function actionManage($id,$session_id)
	{
		
		//echo "zxc"; die();
		$model=ExamRoutine::model()->findByPk($id);
		
		$room=Room::model()->findAll();
		$dates=ExamRoutineDate::model()->findAll("exam_routine_id='".$id."' order by exam_date,id ASC");
		
		//$model3=new ClassRoutine('search');
		//$model3->calendar_id=$calendarinfo_id;
		//$model3->unsetAttributes();  // clear any default values
		//if(isset($_GET['ClassRoutine']))
			//$model3->attributes=$_GET['ClassRoutine'];
			
		$model2=new ExamRoutineDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamRoutineDetail']))
		{
			$model2->attributes=$_POST['ExamRoutineDetail'];
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
		
		
		$this->render('manage',array('model2'=>$model2,'model'=>$model,'session_id'=>$session_id,'dates'=>$dates,'room'=>$room));
	}
	
	
	
	public function actionManage2($id,$session_id)
	{
		
		//echo "zxc"; die();
		$model=ExamRoutine::model()->findByPk($id);
		
		$room=Room::model()->findAll();
		$dates=ExamRoutineDate::model()->findAll("exam_routine_id='".$id."' order by exam_date,id ASC");
		
		//$model3=new ClassRoutine('search');
		//$model3->calendar_id=$calendarinfo_id;
		//$model3->unsetAttributes();  // clear any default values
		//if(isset($_GET['ClassRoutine']))
			//$model3->attributes=$_GET['ClassRoutine'];
			
		$model2=new ExamRoutineDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamRoutineDetail']))
		{
			$model2->attributes=$_POST['ExamRoutineDetail'];
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
		
		
		$this->render('manage2',array('model2'=>$model2,'model'=>$model,'session_id'=>$session_id,'dates'=>$dates,'room'=>$room));
	}
	
	public function actionManage3($id,$session_id)
	{
		
		//echo "zxc"; die();
		$model=ExamRoutine::model()->findByPk($id);
		
		$cnn=ExamRoutineDetail::model()->findAll(array('select'=>'faculty_member_id','group'=>'faculty_member_id','distinct'=>true));
		$cnn2=ExamRoutineDetail::model()->findAll(array('select'=>'additional_faculty_member_id2','group'=>'additional_faculty_member_id2','distinct'=>true));
		$cnn3=ExamRoutineDetail::model()->findAll(array('select'=>'additional_faculty_member_id3','group'=>'additional_faculty_member_id3','distinct'=>true));
		$cnn4=ExamRoutineDetail::model()->findAll(array('select'=>'additional_faculty_member_id4','group'=>'additional_faculty_member_id4','distinct'=>true));
		$cnn5=ExamRoutineDetail::model()->findAll(array('select'=>'additional_faculty_member_id5','group'=>'additional_faculty_member_id5','distinct'=>true));
		$cnn1=ExamRoutineDetail::model()->findAll(array('select'=>'additional_faculty_member_id','group'=>'additional_faculty_member_id','distinct'=>true));
		
		$allid=array();
		
		
		foreach($cnn1 as $c):
		if($c->additional_faculty_member_id>0)
		$allid[]=$c->additional_faculty_member_id;
		endforeach;
		
		foreach($cnn as $c):
		if($c->faculty_member_id>0)
		$allid[]=$c->faculty_member_id;
		endforeach;
		foreach($cnn2 as $c):
		if($c->additional_faculty_member_id2>0)
		$allid[]=$c->additional_faculty_member_id2;
		endforeach;
		foreach($cnn3 as $c):
		if($c->additional_faculty_member_id3>0)
		$allid[]=$c->additional_faculty_member_id3;
		endforeach;
		foreach($cnn4 as $c):
		if($c->additional_faculty_member_id4>0)
		$allid[]=$c->additional_faculty_member_id4;
		endforeach;
		foreach($cnn5 as $c):
		if($c->additional_faculty_member_id5>0)
		$allid[]=$c->additional_faculty_member_id5;
		endforeach;
		
		$na=array_unique($allid);
		
		$fal_mem=implode(",",$na); 
		
		$cnn=FacultyMember::model()->findAll("member_pk in ( ".$fal_mem." ) order by member_name ASC");
		
		$room=Room::model()->findAll();
		$dates=ExamRoutineDate::model()->findAll("exam_routine_id='".$id."' order by exam_date,id ASC");
		
		//$model3=new ClassRoutine('search');
		//$model3->calendar_id=$calendarinfo_id;
		//$model3->unsetAttributes();  // clear any default values
		//if(isset($_GET['ClassRoutine']))
			//$model3->attributes=$_GET['ClassRoutine'];
			
		$model2=new ExamRoutineDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

/*		if(isset($_POST['ExamRoutineDetail']))
		{
			$model2->attributes=$_POST['ExamRoutineDetail'];
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
*/		
		
		$this->render('manage3',array('model2'=>$model2,'model'=>$model,'session_id'=>$session_id,'dates'=>$dates,'room'=>$room,'cnn'=>$cnn));
	}

public function actionManage4($id,$session_id,$date)
	{
		
		$this->layout="print";
		//echo "zxc"; die();
		$model=ExamRoutine::model()->findByPk($id);
		$ddate=ExamRoutineDate::model()->findAll("exam_routine_id='".$id."' and exam_date='".$date."'");
		$did=array();
		foreach($ddate as $dd):
		$did[$dd->id]=$dd->id;
		endforeach;
		$dcdc=implode(",",$did);
		
		//$cnn=ExamRoutineDetail::model()->findAll("exam_date_id='".$ddate->id."' and exam_routine_id='".$model->id."' and session_id='".$session_id."'");
		
		
		$cnn=ExamRoutineDetail::model()->findAll(array('select'=>'batch_id,course_id,department_id,batch_group_id,semester_id','group'=>'batch_id,course_id,department_id,batch_group_id','distinct'=>true));	
		
		$this->render('manage4',array('cnn'=>$cnn,'date'=>$date,'model'=>$model,'ddate'=>$ddate,'dcdc'=>$dcdc));
	}

	/**
	 * Manages all models.
	 */
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
					$where2="";
					
					$course=$_POST['Student']['batch_ref_course_pk'];
					if($course) {
					$course_name=Course::model()->findByPk($course)->course_name;
					if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
					if($where2) $where2 .=" and t.course_id =".$course; else $where2.=" t.course_id =".$course;
					}
					
					
					
					$cname=$_POST['Student']['calendar_name'];
					if($cname) {
					
					if($where) $where .=" and exam_routine_id =".$cname; else $where.=" exam_routine_id =".$cname;
					if($where2) $where2 .=" and t.exam_routine_id =".$cname; else $where2.=" t.exam_routine_id =".$cname;
					}
					
					
					$department=$_POST['Student']['department_id'];
					if($department) {
					$department_name=Department::model()->findByPk($department)->department_name;
					if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;
					if($where2) $where2 .=" and t.department_id =".$department; else $where2.=" department_id =".$department;
					}
					
					$batch=$_POST['Student']['batch_ref'];
					if($batch) {
					$batch_name=Batch::model()->findByPk($batch)->batch_id;
					if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;
					if($where2) $where2 .=" and t.batch_id =".$batch; else $where2.=" t.batch_id =".$batch;
					}
					
					$session=$_POST['Student']['session'];
					if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;
					if($where2) $where2 .=" and t.session_id =".$session; else $where2.=" t.session_id =".$session;
					
					}
					
					$batch_group=$_POST['Student']['batch_group'];
					if($batch_group) {
					$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
					if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
					if($where2) $where2 .=" and t.batch_group_id =".$batch_group; else $where2.=" t.batch_group_id =".$batch_group;
					}
					
					$semester=$_POST['Student']['semester'];
					if($semester) {
					$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
					if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;
					if($where2) $where2 .=" and t.semester_id =".$semester; else $where2.=" t.semester_id =".$semester;
					
					}
					
					//$studentEnInfo=ClassRoutine::model()->findAll($where);
					//$calendar_info=CalendarInfo::model()->findByPk($cname);
					
					
					/*
					$connection=Yii::app()->db;
					$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where ORDER BY class_period.start_time asc");
					$cperiod = $command->queryAll();
					*/
					
					$connection=Yii::app()->db;
					$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM exam_routine_detail where $where order by batch_section_id");
					$section = $command->queryAll();
					
						
						$this->layout='//layouts/'.$card_type;
						$this->renderPartial('_'.$card_type,array(
						'section'=>$section,'where'=>$where,
						'course_name'=>$course_name,'where2'=>$where2,'department_name'=>$department_name,'batch_name'=>$batch_name,
						'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,
					));
					
			}
			elseif($card_type=="student-2")
			{
			
					$where="";
					$where2="";
					
					$course=$_POST['Student']['batch_ref_course_pk'];
					if($course) {
					$course_name=Course::model()->findByPk($course)->course_name;
					if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
					if($where2) $where2 .=" and t.course_id =".$course; else $where2.=" t.course_id =".$course;
					}
					
					
					
					$cname=$_POST['Student']['calendar_name'];
					if($cname) {
					
					if($where) $where .=" and exam_routine_id =".$cname; else $where.=" exam_routine_id =".$cname;
					if($where2) $where2 .=" and t.exam_routine_id =".$cname; else $where2.=" t.exam_routine_id =".$cname;
					}
					
					
					$department=$_POST['Student']['department_id'];
					if($department) {
					$department_name=Department::model()->findByPk($department)->department_name;
					if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;
					if($where2) $where2 .=" and t.department_id =".$department; else $where2.=" department_id =".$department;
					}
					
					$batch=$_POST['Student']['batch_ref'];
					if($batch) {
					$batch_name=Batch::model()->findByPk($batch)->batch_id;
					if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;
					if($where2) $where2 .=" and t.batch_id =".$batch; else $where2.=" t.batch_id =".$batch;
					}
					
					$session=$_POST['Student']['session'];
					if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;
					if($where2) $where2 .=" and t.session_id =".$session; else $where2.=" t.session_id =".$session;
					
					}
					
					$batch_group=$_POST['Student']['batch_group'];
					if($batch_group) {
					$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
					if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
					if($where2) $where2 .=" and t.batch_group_id =".$batch_group; else $where2.=" t.batch_group_id =".$batch_group;
					}
					
					$semester=$_POST['Student']['semester'];
					if($semester) {
					$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
					if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;
					if($where2) $where2 .=" and t.semester_id =".$semester; else $where2.=" t.semester_id =".$semester;
					
					}
					
					//$studentEnInfo=ClassRoutine::model()->findAll($where);
					//$calendar_info=CalendarInfo::model()->findByPk($cname);
					
					
					/*
					$connection=Yii::app()->db;
					$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where ORDER BY class_period.start_time asc");
					$cperiod = $command->queryAll();
					*/
					
					$connection=Yii::app()->db;
					$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM exam_routine_detail where $where order by batch_section_id");
					$section = $command->queryAll();
					
						
						$this->layout='//layouts/'.$card_type;
						$this->renderPartial('_'.$card_type,array(
						'section'=>$section,'where'=>$where,
						'course_name'=>$course_name,'where2'=>$where2,'department_name'=>$department_name,'batch_name'=>$batch_name,
						'session'=>$session,'batch_group_name'=>$batch_group_name,'semester_name'=>$semester_name,
					));
			
			}
			elseif($card_type=="student-3")
			{
			
			$where="";
					$where2="";
					
					$course=$_POST['Student']['batch_ref_course_pk'];
					if($course) {
					$course_name=Course::model()->findByPk($course)->course_name;
					if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;
					if($where2) $where2 .=" and t.course_id =".$course; else $where2.=" t.course_id =".$course;
					}
					
					
					
					$cname=$_POST['Student']['calendar_name'];
					if($cname) {
					
					if($where) $where .=" and exam_routine_id =".$cname; else $where.=" exam_routine_id =".$cname;
					if($where2) $where2 .=" and t.exam_routine_id =".$cname; else $where2.=" t.exam_routine_id =".$cname;
					}
					
					
					$department=$_POST['Student']['department_id'];
					if($department) {
					$department_name=Department::model()->findByPk($department)->department_name;
					if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;
					if($where2) $where2 .=" and t.department_id =".$department; else $where2.=" department_id =".$department;
					}
					
					$batch=$_POST['Student']['batch_ref'];
					if($batch) {
					$batch_name=Batch::model()->findByPk($batch)->batch_id;
					if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;
					if($where2) $where2 .=" and t.batch_id =".$batch; else $where2.=" t.batch_id =".$batch;
					}
					
					$session=$_POST['Student']['session'];
					if($session) {if($where) $where .=" and session_id =".$session; else $where.=" session_id =".$session;
					if($where2) $where2 .=" and t.session_id =".$session; else $where2.=" t.session_id =".$session;
					
					}
					
					$batch_group=$_POST['Student']['batch_group'];
					if($batch_group) {
					$batch_group_name=BatchGroup::model()->findByPk($batch_group)->group_name;
					if($where) $where .=" and batch_group_id =".$batch_group; else $where.=" batch_group_id =".$batch_group;
					if($where2) $where2 .=" and t.batch_group_id =".$batch_group; else $where2.=" t.batch_group_id =".$batch_group;
					}
					
					$semester=$_POST['Student']['semester'];
					if($semester) {
					$semester_name=CourseSemesterLebel::model()->semesterLebel($course,$semester,0);
					if($where) $where .=" and semester_id =".$semester; else $where.=" semester_id =".$semester;
					if($where2) $where2 .=" and t.semester_id =".$semester; else $where2.=" t.semester_id =".$semester;
					
					}
					
					//$studentEnInfo=ClassRoutine::model()->findAll($where);
					//$calendar_info=CalendarInfo::model()->findByPk($cname);
					
					
					/*
					$connection=Yii::app()->db;
					$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine LEFT JOIN class_period ON class_period.id=class_routine.class_period_id where $where ORDER BY class_period.start_time asc");
					$cperiod = $command->queryAll();
					*/
					
					$connection=Yii::app()->db;
					$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM exam_routine_detail where $where order by batch_section_id");
					$section = $command->queryAll();
					
						
						$this->layout='//layouts/'.$card_type;
						$this->renderPartial('_'.$card_type,array(
						'section'=>$section,'where'=>$where,
						'course_name'=>$course_name,'where2'=>$where2,'department_name'=>$department_name,'batch_name'=>$batch_name,
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
			
			
					
					
					
					
					
					
					
					
					
						
						$this->layout='//layouts/'.$card_type;
						$this->renderPartial('_'.$card_type,array(
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
	public function actionAdmin()
	{
		$model=new ExamRoutine('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ExamRoutine']))
			$model->attributes=$_GET['ExamRoutine'];

		$this->render('admin',array(
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
		$model=ExamRoutine::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='exam-routine-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
