<?php

class CalendarController extends Controller
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
		return array(
			array(
				'allow',
				'actions' => array('index', 'view', 'create', 'update', 'delete','process','finalDataProcess'),
				'users' => array('admin'),
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(Yii::app()->request->isAjaxRequest){
			echo CJSON::encode(array(
				'div'=>$this->renderPartial('view', array('model'=>$this->loadModel($id)), true)
				));
			exit;
		}
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
		$model=new AttendanceCalendar;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AttendanceCalendar']))
		{
			
			
		
			
			$model->attributes=$_POST['AttendanceCalendar'];
			
			//print_r($_POST['AttendanceCalendar']['courses']); die();
			
			foreach($_POST['AttendanceCalendar']['courses'] as $cour):
			
				echo $cour." ";
				$model2=new AttendanceCalendar;
				$model2->attributes=$_POST['AttendanceCalendar'];
				
				
				$model2->course_id=$cour;
				
				$model2->save();
			endforeach;
			
			/*
			if($model->save())
			{
				if(Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
						'status'=>'success',
						'div'=>Yii::t('attendance', 'Successfully Created.'),
					));
					exit;
				}
				$$this->redirect(array('index'));
			}*/
			$$this->redirect(array('index'));
		}
		/*
		if(Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				'status'=>'failure',
				'url'=>  Yii::app()->createUrl('attendance/calendar/create'),
				'div'=>$this->renderPartial('_form', array('model'=>$model), true)
			));
			exit;
		}*/

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

		if(isset($_POST['AttendanceCalendar']))
		{
			$model->attributes=$_POST['AttendanceCalendar'];
			if($model->save())
			{
				if(Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
						'status'=>'success',
						'div'=>Yii::t('attendance', 'Successfully Updated.'),
					));
					exit;
				}
				$this->redirect(array('index'));
			}
		}

		if(Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				'status'=>'failure',
				'url'=>  Yii::app()->createUrl('attendance/calendar/update', array('id'=>$id)),
				'div'=>$this->renderPartial('_form', array('model'=>$model), true)
			));
			exit;
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
		$model=new AttendanceCalendar('search');
		$this->render('index',array(
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
		$model=AttendanceCalendar::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='attendance-calendar-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionFinalDataProcess($id)
	{
		
		$model = $this->loadModel($id);
		
		$allemp=CoreEmployee::model()->findAll();
		
		//echo count($allemp);
		
		//if($allemp) echo "asdasd"; die();
		$i=1;
		foreach($allemp as $emp):
		if($emp->status!="Inactive") 
		{
	
	
		if($emp->id==165) echo "emp_id='".$emp->id."' and date='".$model->date."'";
		$emp_calendar=EmpShiftCalendar::model()->find("emp_id='".$emp->id."' and date='".$model->date."'");
		
		
		
		$finalData = AttendanceFinalData::model()->find("core_employee_id='".$emp->id."' AND date='".$model->date."'");
		if(empty($finalData))
		$finalData = new AttendanceFinalData();
		
		
		
		$finalData->core_employee_id = $emp->id;
		$finalData->core_employee_name = $emp->name;
		
		$finalData->core_department_id = $emp->department->id;
		$finalData->core_department_name = $emp->department->name;
		$finalData->date = $model->date;
		$finalData->json_log = "";
				
		
		$status="";
		//echo "czxc"; die();
		if($emp_calendar)
		{
		//echo $emp_calendar->always_present;
		//echo " | ".$emp_calendar->shift_id." | ";
		
			$ac=AttendanceCalendar::model()->find("date='".$model->date."'");
			
			$finalData->core_shift_id = $emp_calendar->shift_id;
			$finalData->core_shift_name = $emp_calendar->shift->name;
		
			$al=AttendanceLeave::model()->find("core_employee_id='".$emp->id."' and ( start_date='".$model->date."' or end_date='".$model->date."' or ('".$model->date."'>=start_date and '".$model->date."'<=end_date) )");
			
			if($al)
			{
				$finalData->status=$al->type." ";
				$finalData->save();
			}
			if($emp_calendar->shift_id==17)
			{
			//echo "zxcx";
				$finalData->status="O ";
				$finalData->save();
			}
				
			
			elseif($emp_calendar->always_present=="Yes")
			{
			
				//if($emp->id==45) {echo $emp_calendar->shift->start_time; die();}
				$finalData->in_time=$model->date." ".$emp_calendar->shift->start_time;
				$finalData->out_time=$model->date." ".$emp_calendar->shift->end_time;
				$finalData->status="P ";
				$finalData->save();
			}
			
			elseif(isset($ac))
			{
				if($ac->type=="HO")
				{
			
				$finalData->status="O ";
				$finalData->save();
				}
				elseif(!isset($finalData->id))
				{$finalData->status="A ";
				$finalData->save();
				}
			}
			
			else 
			{	
				if(!isset($finalData->id))
				{$finalData->status="A ";
				$finalData->save();
				}
			}
			
			
		}
		else 
		{
			$finalData->status="ND ";
			$finalData->save();
		}
		
		
		//echo $finalData->id." ";
		}
		endforeach;
		
			$model->status = 1;
			$model->processed_on = date('Y-m-d H:i:s');
			$model->save(false);
		
		$this->redirect(array('index'));
		//$model2->finalDataProcess($model2->date);
		//echo $id; die();
		//$model->finalDataProcess($model2->date);	
	}

	public function actionProcess($id)
	{
		$model = $this->loadModel($id);
		if($model->process())
		{
			$model->status = 1;
			$model->processed_on = date('Y-m-d H:i:s');
			$model->save(false);
		}
		//$this->redirect(array('index'));
	}
}
