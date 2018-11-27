<?php

class AccountController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','firstprocess','financeProcess','collection'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','financeProcess'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/
	
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
		$model=new AccountProcess;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AccountProcess']))
		{
			$model->attributes=$_POST['AccountProcess'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        
        
        
        public function actionCollection()
	{
		$model=new StudentCollection;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AccountProcess']))
		{
			$model->attributes=$_POST['AccountProcess'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        
        public function actionFirstprocess($id="")
	{
		
            
               StudentCollection::model()->deleteAll();
               StudentRemaining::model()->deleteAll();
               StudentCollectionDetail::model()->deleteAll();
               StudentDues::model()->deleteAll();
                $all_student=StudentEnrollmentInfo::model()->findAll("session='$id'");
                
                
                
		foreach($all_student as $std)
                {
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
                            $smod->save();
                            
                            
                    
                    for($i=1;$i<=12;$i++)
                    {
                    
                    $collection_head=CollectionHead::model()->findAll("session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='$i' or apply_on_month='0')");
                    
                    
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
                                $mod->month=$i;
                                
                                $mod->save();
                             $tatal_deposit=$tatal_deposit - $ch->collection_amount;   
                        }
                        else  
                            
                        { 
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
                        }
                    
                    //echo $std->id;
                    
                    }
                    }
                    
                    if($tatal_deposit)
                    {
                        $nmod=new StudentRemaining;
                        $nmod->student_pk=$std->student_pk;
                        $nmod->student_id=$std->student_id;
                        $nmod->remaining_amount=$tatal_deposit;
                        $nmod->description='Enrollment';
                        $nmod->save();
                    }
                    
                    
                }
                
                /*
		$this->render('create',array(
			'model'=>$model,
		));
                 
                 */
           
	}
        
       
        public function actionFinanceProcess($id="")
	{
               /*
                $student_collection=StudentCollection::model()->findAll("student_id=".$id);
               $student_remaining=StudentRemaining::model()->find("student_id=".$id);
               $student_collection_detail=StudentCollectionDetail::model()->findAll("student_id=".$id);
               $student_dues=StudentDues::model()->findAll("student_id=".$id);
               
                $all_student=StudentEnrollmentInfo::model()->findAll("session='$id'");
                */
		
                //echo $id; die();
                $bndate = new Bndate(strtotime(date("Y-m-d")));
                $month=$bndate->BanglaNumMonth2();
                $date=$bndate->get_date();
                $year=$bndate->getBnToEnYear($date[2]);
               
                $sein=StudentEnrollmentInfo::model()->find("session='$year' and student_id=".$id);
                $count=0;
                
                if($sein)
                {
                StudentDues::model()->deleteAll("student_id=".$id);
                for($i=1;$i<=$month; $i++)
                {
                    
                   // echo "student_id=".$id." and month=".$i." and year=".$year; die();
                    $student_collection=StudentCollection::model()->find("student_id='".$id."' and month='".$i."' and year='".$year."'");
                    //if($student_collection) echo " and month=".$i." and year=".$year." ";
                    
                    if($student_collection);
                    else{
                    
                        //print_r($sein); die();
                           // echo "session='$year' and course='";//.$sein->course_id."' ";//and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0')"; die();

                            $collection_head=CollectionHead::model()->findAll("session='$year' and course='".$sein->course_id."' and student_type='".$sein->enrollment_status."' and ( apply_on_month='$i' or apply_on_month='0')");


                            foreach ($collection_head as $ch)

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
                                        
                                        $amount=0;
                                        if($count==4)
                                        $amount=100;
                                        
                                        if($count>4 && $count<=12)
                                        $amount=100+(($count-4)*50);
                                        
                                        if($amount>0)
                                        {
                                            StudentFine::model()->deleteAll("student_pk=".$sein->student_pk);
                                            $umod=new StudentFine;
                                            $umod->student_pk=$sein->student_pk;
                                            $umod->student_id=$sein->student_id;
                                            $umod->amount=$amount;
                                            $umod->session_id=$year;
                                            $umod->fine_date=date("Y-m-d H:i:s");
                                            $umod->year=$year;
                                            $umod->month=$i;
                                            $umod->comment="Fine";
                                            $umod->save();
                                        }
                                        $count++;
                                    }
                               

                            //echo $std->id;

                            }
                            
                    
                    //$student_dues=StudentDues::model()->findAll("student_id=".$id);
                    
                    
                    
                    }
                    
                }
                
                }
                
			//echo $date[0].' '.$date[1].' '.$date[2];
            
                //echo Bndate::t(date("Y-m-d")); die();
                
                
                /*
                
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
                            $smod->save();
                            
                            
                    
                    for($i=1;$i<=4;$i++)
                    {
                    
                    $collection_head=CollectionHead::model()->findAll("session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='$i' or apply_on_month='0')");
                    
                    
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
                                $mod->month=$i;
                                
                                $mod->save();
                             $tatal_deposit=$tatal_deposit - $ch->collection_amount;   
                        }
                        else  
                            
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
                    
                    //echo $std->id;
                    
                    }
                    }
                    
                    if($tatal_deposit)
                    {
                        $nmod=new StudentRemaining;
                        $nmod->student_pk=$std->student_pk;
                        $nmod->student_id=$std->student_id;
                        $nmod->remaining_amount=$tatal_deposit;
                        $nmod->description='Enrollment';
                        $nmod->save();
                    }
                    
                  */
                
                /*
		$this->render('create',array(
			'model'=>$model,
		));
                 
                 */
           
	}
        
        
        
        public function actionProcess($id="")
	{
		
            if($id)
            {
                $model=$this->loadModel($id);
                
               // StudentEnrollmentInfo::model()->findAll
                
		
		$this->render('create',array(
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

		if(isset($_POST['AccountProcess']))
		{
			$model->attributes=$_POST['AccountProcess'];
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
		$model=new AccountProcess('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AccountProcess']))
			$model->attributes=$_GET['AccountProcess'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AccountProcess('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AccountProcess']))
			$model->attributes=$_GET['AccountProcess'];

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
		$model=AccountProcess::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-process-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
