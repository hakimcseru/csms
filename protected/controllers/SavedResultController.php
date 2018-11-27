<?php

class SavedResultController extends Controller
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
		$model=new SavedResult;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SavedResult']))
		{
			$model->attributes=$_POST['SavedResult'];
			

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	public function actionAddresult()
	{
		$model=new SavedResult;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SavedResult']))
		{
			$model->attributes=$_POST['SavedResult'];
			//print_r($_POST);
			//echo $_POST['SavedResult']['course_id']; die();
			$model->course=Course::model()->findByPk($model->course_id)->course_name;
			$model->department=Department::model()->findByPk($model->department_id)->department_name;
			$model->semester=CourseSemesterLebel::model()->semesterLebel($model->course_id,$model->semester_id,0);
			//BatchGroup::model()->findByPk($model->batch_group_id)->group_name;
			$model->batch_group=BatchGroup::model()->findByPk($model->batch_group_id)->group_name;
			$model->saved_date=date("Y-m-d H:i:s");
			$model->saved_by=Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('addresult',array(
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

		if(isset($_POST['SavedResult']))
		{
			$model->attributes=$_POST['SavedResult'];
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
	public function actionDelete($batch_id,$session_id,$course,$department,$semester,$batch_group)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			
			$model=new SavedResult;
		$criteria=new CDbCriteria;

		$criteria->compare('batch_id',$batch_id);
		$criteria->compare('session_id',$session_id);
		$criteria->compare('course',$course,true);
		$criteria->compare('department',$department,true);
		$criteria->compare('semester',$semester,true);
		$criteria->compare('batch_group',$batch_group,true);
		
		$model2=$model->findAll($criteria);
		
		foreach($model2 as $mod):
			if($mod->delete())
			{
			SavedResultSubject::model()->deleteAll("saved_result_id=".$mod->id);
			}
		endforeach;	

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	
	public function actionRemove($batch_id,$session_id,$course,$department,$semester,$batch_group)
	{
		
			
			$model=new SavedResult;
		$criteria=new CDbCriteria;

		$criteria->compare('batch_id',$batch_id);
		$criteria->compare('session_id',$session_id);
		$criteria->compare('course',$course,true);
		$criteria->compare('department',$department,true);
		$criteria->compare('semester',$semester,true);
		$criteria->compare('batch_group',$batch_group,true);
		
		$model2=$model->findAll($criteria);
		
		foreach($model2 as $mod):
			if($mod->delete())
			{
			SavedResultSubject::model()->deleteAll("saved_result_id=".$mod->id);
			}
		endforeach;	

		$this->redirect(array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SavedResult');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	public function actionSavedTabulation($batch_id,$session_id,$course,$department,$semester,$batch_group)
	{
		$model=new SavedResult;
		$criteria=new CDbCriteria;

		$criteria->compare('batch_id',$batch_id);
		$criteria->compare('session_id',$session_id);
		$criteria->compare('course',$course,true);
		$criteria->compare('department',$department,true);
		$criteria->compare('semester',$semester,true);
		$criteria->compare('batch_group',$batch_group,true);
		
		//$criteria->select = 'session_id, course, department, semester, batch_id, batch_group';
		
		$this->render('savedTabulation',array(
			'model'=>$model->findAll($criteria),'model2'=>$model->find($criteria),'batch_id'=>$batch_id, 'session_id'=>$session_id,'course'=>$course, 'department'=>$department, 'semester'=>$semester,'batch_group'=>$batch_group
		));
		
		
		
		
	}
	
	public function actionPrintTabulation($batch_id,$session_id,$course,$department,$semester,$batch_group)
	{
		$this->layout='//layouts/print';
		$model=new SavedResult;
		$criteria=new CDbCriteria;

		$criteria->compare('batch_id',$batch_id);
		$criteria->compare('session_id',$session_id);
		$criteria->compare('course',$course,true);
		$criteria->compare('department',$department,true);
		$criteria->compare('semester',$semester,true);
		$criteria->compare('batch_group',$batch_group,true);
		
		//$criteria->select = 'session_id, course, department, semester, batch_id, batch_group';
		
		$this->render('printTabulation',array(
			'model'=>$model->findAll($criteria),'model2'=>$model->find($criteria),'batch_id'=>$batch_id, 'session_id'=>$session_id,'course'=>$course, 'department'=>$department, 'semester'=>$semester,'batch_group'=>$batch_group
		));
		
		
		
		
	}
	
	
	public function actionExcelTabulation($batch_id,$session_id,$course,$department,$semester,$batch_group)
	{
		$this->layout='//layouts/print';
		$model=new SavedResult;
		$criteria=new CDbCriteria;

		$criteria->compare('batch_id',$batch_id);
		$criteria->compare('session_id',$session_id);
		$criteria->compare('course',$course,true);
		$criteria->compare('department',$department,true);
		$criteria->compare('semester',$semester,true);
		$criteria->compare('batch_group',$batch_group,true);
		
		//$criteria->select = 'session_id, course, department, semester, batch_id, batch_group';
		
		/*$this->render('printTabulation',array(
			'model'=>$model->findAll($criteria),'model2'=>$model->find($criteria),'batch_id'=>$batch_id, 'session_id'=>$session_id,'course'=>$course, 'department'=>$department, 'semester'=>$semester,'batch_group'=>$batch_group
		));*/
		
		Yii::app()->request->sendFile("Tabulation.xls", $this->renderPartial('printTabulation', array('model'=>$model->findAll($criteria),'model2'=>$model->find($criteria),'batch_id'=>$batch_id, 'session_id'=>$session_id,'course'=>$course, 'department'=>$department, 'semester'=>$semester,'batch_group'=>$batch_group),TRUE));

		
		
		
		
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
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SavedResult('search3');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SavedResult']))
			$model->attributes=$_GET['SavedResult'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionAdmin2()
	{
		$model=new SavedResult('search3');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SavedResult']))
			$model->attributes=$_GET['SavedResult'];

		$this->render('admin2',array(
			'model'=>$model,
		));
	}
	
	public function actionPrintmarksheet()
	{
		$this->layout='print';
		if(isset($_POST['someChecks']) && $_POST['someChecks']!=""){  
		
		$iidds=implode(",",$_POST['someChecks']);
        $criteria=new CDbCriteria;
		$criteria->condition="id in (".$iidds.")";
		$criteria->order="roll_no ASC";
		$model=SavedResult::model()->findAll($criteria);
		/*
		$dataProvider = new CActiveDataProvider('SavedResult', array(
			'criteria'=>$criteria,
			'pagination'=>false,
			));*/
		
		
		$this->render('print_marksheet',array(
			'models'=>$model,
		));
	}
	}
	
	public function actionPrintmarksheetSingle($id)
	{
		$this->layout='print';
        $criteria=new CDbCriteria;
		$criteria->condition="id = ".$id;
		$model=SavedResult::model()->findAll($criteria);
		/*
		$dataProvider = new CActiveDataProvider('SavedResult', array(
			'criteria'=>$criteria,
			'pagination'=>false,
			));*/
		
		
		$this->render('print_marksheet',array(
			'models'=>$model,
		));
	
	}
	
	public function actionMarksheet()
	{
	
		$model=new SavedResult('search2');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SavedResult']))
			$model->attributes=$_GET['SavedResult'];

		$model->session_id=$_GET['session'];
		$model->course_id=$_GET['course'];
		$model->department_id=$_GET['department'];
		$model->semester_id=$_GET['semester'];
		$model->batch_id=$_GET['batch_id'];
		$model->batch_group_id=$_GET['batch_group'];
		
		$this->render('marksheet',array(
			'model'=>$model,
		));
	}
	
	
	public function actionMarksheet2($batch_id,$session_id,$course,$department,$semester,$batch_group)
	{
	
		$criteria=new CDbCriteria;

		$criteria->compare('batch_id',$batch_id);
		$criteria->compare('session_id',$session_id);
		$criteria->compare('course',$course,true);
		$criteria->compare('department',$department,true);
		$criteria->compare('semester',$semester,true);
		$criteria->compare('batch_group',$batch_group,true);
		
		$model=new CActiveDataProvider('SavedResult', array(
			'criteria'=>$criteria,
			'pagination' => false,
		));
		
		$this->render('marksheet2',array(
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
		$model=SavedResult::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='saved-result-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	///////////////////
	public function actionCourse() {
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['SavedResult']['course_id']);
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
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['SavedResult']['course_id']);
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
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['SavedResult']['batch_id']);
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
				
				$cou = Course::model()->findByPk($_POST['SavedResult']['course_id']);
				
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
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$_POST['SavedResult']['course_id']." and semester_id=".$i);
					echo CHtml::tag('option',
							   array('value'=>$i),$clebel->lebel,true);
				}
				}
				}
				
		}
  
  

  
	
	public function actionSubject() {
				//$models = CourseSubject::model()->findAll("course_subject_ref_course_pk=".$_POST['SavedResult']['course']." and course_subject_department_id=".$_POST['SavedResult']['department']);
               
				//print_r($models); die();
				$courseSubject = new CourseSubject('search');
			$courseSubject->unsetAttributes();  // clear any default values
			$courseSubject->course_subject_ref_course_pk = $_POST['SavedResult']['course_id'];
			$courseSubject->course_subject_department_id = $_POST['SavedResult']['department_id'];
			$courseSubject->course_subject_semester_no = $_POST['SavedResult']['semester_id'];
			
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
