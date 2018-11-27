<?php

class ExamRoutineDetailController extends Controller
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
	 /*
	public function actionCreate()
	{
		$model=new ExamRoutineDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamRoutineDetail']))
		{
			$model->attributes=$_POST['ExamRoutineDetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/
	
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
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['ExamRoutineDetail']['course_id']);
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
  
				$course=Course::model()->findByPk($_POST['ExamRoutineDetail']['course_id']);
				//echo $course->semester; die();
				$semester=$course->allSemisterLebelsArray($_POST['ExamRoutineDetail']['course_id'],$course->semester);
				
				//$model = CourseDepartment::model()->findAll("course_id=".$_POST['ExamRoutineDetail']['course_id']);
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
  
				
				$subject=CourseSubject::model()->findAll("course_subject_ref_course_pk=".$_POST['ExamRoutineDetail']['course_id']." and course_subject_semester_no=".$_POST['ExamRoutineDetail']['semester_id']." and course_subject_department_id=".$_POST['ExamRoutineDetail']['department_id']);
				
				//$course=Course::model()->findByPk($_POST['ExamRoutineDetail']['course_id']);
				//echo $course->semester; die();
				//$semester=$course->allSemisterLebelsArray($_POST['ExamRoutineDetail']['course_id'],$course->semester);
				
				//$model = CourseDepartment::model()->findAll("course_id=".$_POST['ExamRoutineDetail']['course_id']);
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
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['ExamRoutineDetail']['course_id']);
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
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['ExamRoutineDetail']['batch_id']);
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
   
				//echo "batch_group_id=".$_POST['ExamRoutineDetail']['batch_group_id'];
				$model = BexamRoutineGroup::model()->findAll("batch_group_id=".$_POST['ExamRoutineDetail']['batch_group_id']." and session_id=".$_POST['ExamRoutineDetail']['session_id']);
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
 
 public function actionPrintBlankMarkSheet($id)
 {
	$this->layout="print";
	$model=$this->loadModel($id);
	$this->render("print_blank_markSheet",array('id'=>$id, 'model'=>$model));
 }
 
	public function actionCreate($session_id,$room_id,$exam_date_id,$exam_routine_id)
								 
	{
		//die($session_id);
		$model=new ExamRoutineDetail;
		$model->session_id=$session_id;
		$model->room_id=$room_id;
		$model->exam_date_id=$exam_date_id;
		//$model->weekday=$weekday;
		$model->exam_routine_id=$exam_routine_id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamRoutineDetail']))
		{
			$model->attributes=$_POST['ExamRoutineDetail'];
			
			$error=0;
			
			$cr=ExamRoutineDetail::model()->find("
			(faculty_member_id='".$_POST['ExamRoutineDetail']['faculty_member_id']."' 
			or additional_faculty_member_id='".$_POST['ExamRoutineDetail']['faculty_member_id']."' 
			or faculty_member_id='".$_POST['ExamRoutineDetail']['additional_faculty_member_id']."' 
			or additional_faculty_member_id='".$_POST['ExamRoutineDetail']['additional_faculty_member_id']."') 
			and exam_date_id='".$_POST['ExamRoutineDetail']['exam_date_id']."' and session_id='".$_POST['ExamRoutineDetail']['session_id']."' and exam_routine_id='".$model->exam_routine_id."'");
			
			if($cr)
			{
				$aff=$cr->A_facultyMember?$cr->A_facultyMember->member_name:"";
				if($cr->room_id!=$_POST['ExamRoutineDetail']['room_id'])				
				$error=1;
			}
			
			if($error)
			{
			
			$fm=FacultyMember::model()->findByPk($_POST['ExamRoutineDetail']['faculty_member_id'])->member_name;
			$afm=FacultyMember::model()->findByPk($_POST['ExamRoutineDetail']['additional_faculty_member_id'])->member_name;
			
				Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> It conflict with: <br /> '.$cr->facultyMember->member_name .'->'.$fm.' 
			<br />'.$aff.
			' -> '.$afm.', <br/> Please check.');
				//echo "It matched with";
			}
			else{
			
			if($model->save())
			{
				
				
				//$this->redirect(array('manage','id'=>$model->id));
				$this->redirect(array('examRoutine/manage','id'=>$model->exam_routine_id,'session_id'=>$model->session_id));
				
			}
			}
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

		if(isset($_POST['ExamRoutineDetail']))
		{
			$model->attributes=$_POST['ExamRoutineDetail'];
			if($model->save())
				$this->redirect(array('examRoutine/manage','id'=>$model->exam_routine_id,'session_id'=>$model->session_id));
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
		$dataProvider=new CActiveDataProvider('ExamRoutineDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ExamRoutineDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ExamRoutineDetail']))
			$model->attributes=$_GET['ExamRoutineDetail'];

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
		$model=ExamRoutineDetail::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='exam-routine-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
