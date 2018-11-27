<?php

/**
 * This is the model class for table "student_enrollment_info".
 *
 * The followings are the available columns in table 'student_enrollment_info':
 * @property string $id
 * @property string $enrollment_status
 * @property string $student_id
 * @property integer $course_id
 * @property integer $batch_id
 * @property integer $batch_group
 * @property integer $bank_id
 * @property double $total_deposit
 * @property string $deposit_date
 * @property string $input_datetime
 * @property integer $semester
 * @property string $session
 * @property integer $department_id
 * @property string $student_pk
 * @property integer $roll_no
 */
class StudentEnrollmentInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentEnrollmentInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
public $maxId;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student_enrollment_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enrollment_status, student_id, course_id, batch_id, batch_group, bank_id, total_deposit, deposit_date, input_datetime, semester, session, department_id, student_pk', 'required'),
			array('course_id, batch_id, batch_group, bank_id, semester, department_id, roll_no', 'numerical', 'integerOnly'=>true),
			array('total_deposit', 'numerical'),
			array('enrollment_status, full_free', 'length', 'max'=>10),
			array('student_id, student_pk', 'length', 'max'=>120),
				array('admission_reference', 'length', 'max'=>120),
				array('comment', 'safe'),

			array('session', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, enrollment_status,full_free, student_id, admission_reference, course_id, batch_id, batch_group, bank_id, total_deposit, deposit_date, input_datetime, semester, session, department_id, student_pk, roll_no', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
			'student' => array(self::BELONGS_TO, 'Student', 'student_pk'),
			'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
			'bank' => array(self::BELONGS_TO, 'BankInfo', 'bank_id'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group'),

			
			
			'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester','course_id'=>'course_id')),

			
			'studentres' => array(self::HAS_ONE, 'SavedResult', array('student_id' => 'student_id','session_id'=>'session')


				 ),

				 /*
			 'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', '',
				 'on' => 'semester_id=semesterLevel.semester_id ',

				'condition'=>'semester=semesterLevel.semester_id',
				 //'joinType'=>'INNER JOIN'
				 ),*/

		);
	}
/*
	public function studentres($student_id, $session_id)
	{
		if($student_id && $session_id)
		return $this->find("student_id=".$student_id." and session='".$session_id."'");
		else return false;
	}
	*/
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core','ID'),
			'student_id' => Yii::t('core','Student ID'),
			'course_id' => Yii::t('core','Course'),
			'batch_id' => Yii::t('core','Batch'),
			'bank_id' => Yii::t('core','Bank'),
			'total_deposit' => Yii::t('core','Total Deposit'),
			'deposit_date' => Yii::t('core','Deposit Date'),
			'input_datetime' => Yii::t('core','Input Datetime'),
			'department_id' => Yii::t('core','Department'),
			'student_pk' => Yii::t('core','Student'),
			'semester' => Yii::t('core','Semester'),
			'roll_no' => Yii::t('core','Roll No'),
			'batch_group' => Yii::t('core','Batch Group'),
			'session'=> Yii::t('core','Session'),
			'enrollment_status'=> Yii::t('core','Enrollment Status'),
			'admission_reference'=>Yii::t('core','Admission Reference'),
		);
	}
	public function getMinPay($session_id,$course_id, $student_type)
	{
				
				$collection_head=CollectionHead::model()->findAll("session='".$session_id."' and course='".$course_id."' and student_type='".$student_type."' and ( apply_on_month='1' or apply_on_month='0')");
				
				$minpay=0;
		
				foreach($collection_head as $sh):
				
				if($sh->apply_on_month==0) $mm=$sh->collection_amount*3;
				else $mm=$sh->collection_amount;
				
				$minpay=$minpay+$mm;
				endforeach;
	
				return $minpay;
	}
	public function totaldues($eninfo,$model)	
{
		$total_dues=0;
		if($eninfo->full_free=='Yes')
		 return $total_dues;
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

		return $st;

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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('enrollment_status',$this->enrollment_status,false);
                
                if ($this->student_id) {
                                if (strpos($this->student_id,',') !==false) {
                                     $st_ids = explode(',',$this->student_id);               
                                     foreach($st_ids as $st_id) {
                                             $criteria->compare('t.student_id',$st_id,true,'OR');
                                             //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                     } 
                                } 
                                elseif (strpos($this->student_id,'-') !==false) {
                                     $st_ids = explode('-',$this->student_id);
                                     if(count($st_ids)==2)
                                     {
                                         
                                        if($st_ids[0]<$st_ids[1])
                                        { 
                                            for ($r=$st_ids[0];$r<=$st_ids[1];$r++)

                                            {
                                                   $criteria->compare('t.student_id',$r,true,'OR');
                                                   //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                           } 
                                        }
                                     }
                                }
                                
                                else {
                                  $criteria->compare('t.student_id',$this->student_id,true);
                                }
                    }
                
		//$criteria->compare('t.student_id',$this->student_id,true);
                //$criteria->compare('t.student_id','10008082',true);
		//$criteria->compare('course_id',$this->course_id);

		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('total_deposit',$this->total_deposit);
		$criteria->compare('deposit_date',$this->deposit_date,true);
		$criteria->compare('input_datetime',$this->input_datetime,true);
		//$criteria->compare('semester',$this->semester,true);
		$criteria->compare('session',$this->session,true);
                
                
                if(!Yii::app()->request->isAjaxRequest)
               $criteria->order="roll_no ASC";

                
		//$criteria->compare('student_pk',$this->student_pk,true);
		//$criteria->compare('roll_no',$this->roll_no,false);
                
                if ($this->roll_no) {
                                if (strpos($this->roll_no,',') !==false) {
                                     $st_ids = explode(',',$this->roll_no);               
                                     foreach($st_ids as $st_id) {
                                             $criteria->compare('t.roll_no',$st_id,false,'OR');
                                             //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                     } 
                                } 
                                elseif (strpos($this->roll_no,'-') !==false) {
                                     $st_ids = explode('-',$this->roll_no);
                                     if(count($st_ids)==2)
                                     {
                                         
                                        if($st_ids[0]<$st_ids[1])
                                        { 
                                            for ($r=$st_ids[0];$r<=$st_ids[1];$r++)

                                            {
                                                   $criteria->compare('t.roll_no',$r,false,'OR');
                                                   //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                           } 
                                        }
                                     }
                                }
                                
                                else {
                                  $criteria->compare('t.roll_no',$this->roll_no,false);
                                }
                    }
                
                
                
                
                
		$criteria->together = true;
		$criteria->with=array('course','student','batch','department','batchgroup','semesterLevel');
		$criteria->compare('course.course_name',$this->course_id,true);

		$criteria->compare('batch.batch_id',$this->batch_id,true);
		$criteria->compare('department.department_name',$this->department_id,true);

		$criteria->compare('batchgroup.group_name',$this->batch_group,true);
		//$criteria->compare('batchgroup.group_name',$this->batch_group,true);

		$criteria->compare('student.student_name',$this->student_pk,true);
                
                //if($this->semester)
                //$criteria->condition="semesterLevel.lebel='".$this->semester."'";
		$criteria->compare('semesterLevel.lebel',$this->semester,false);

		$criteria->compare('admission_reference',$this->admission_reference,true);
		
		$criteria->compare('full_free',$this->full_free,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>40),
		));
	}
	
	public function searchNotification()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('enrollment_status',$this->enrollment_status,false);
                
                
                

		$criteria->compare('course_id',$this->course_id);

		
		
		
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('session',$this->session,true);
                
                
                

                
		

                
 
		$criteria->compare('course_id',$this->course_id,true);

		$criteria->compare('batch_id',$this->batch_id,true);
		$criteria->compare('department_id',$this->department_id,true);

		$criteria->compare('batch_group',$this->batch_group,true);
		//$criteria->compare('batchgroup.group_name',$this->batch_group,true);

		$criteria->compare('student_id',$this->student_id,true);
                
                //if($this->semester)
                //$criteria->condition="semesterLevel.lebel='".$this->semester."'";
		$criteria->compare('semester',$this->semester,false);

		
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}