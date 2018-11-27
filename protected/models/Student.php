<?php

/**
 * This is the model class for table "{{student}}".
 *
 * The followings are the available columns in table '{{student}}':
 * @property string $student_id
 * @property string $student_name
 * @property string $student_father_name
 * @property string $student_mother_name
 * @property string $student_present_address
 * @property string $student_permanent_address
 * @property string $student_nationality
 * @property string $student_gender
 * @property string $student_dob
 * @property string $student_pob
 * @property string $student_profession
 * @property string $student_email
 * @property string $student_fb_id
 * @property string $student_contact
 * @property string $student_blood_group
 * @property string $student_qualification
 * @property string $student_alternate_contact
 * @property string $student_reason_of_photography
 * @property string $student_expectation
 * @property string $student_pk
 * @property string $student_ref_batch_pk
 *
 * The followings are the available relation in Student model:
 * @property Batch $batch
 */
class Student extends CActiveRecord
{
	public $enumGender = array('MALE'=> 'ছেলে', 'FEMALE'=> 'মেয়ে');
	public $enumBloodGroup = array('A+', 'A-', 'AB+', 'AB-', 'B+', 'B-', 'O+', 'O-');
	public $batch_ref_course_pk;
	public $batch_ref;
	public $bank_info;
	public $total_deposit;
	public $date_of_deposit;
	public $semester;
	public $session;
	public $department_id;
	public $batch_group;
	public $enrollment_status;
	public $admission_reference;
	public $course_semester_lebel;
	public $card_type;
        public $roll_no_start;
        public $roll_no_end;
		public $calendar_name;
		public $roll_no;
		
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public $full_free;
	public $comment;
	public $session_id; 
	
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{student}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, student_name ', 'required'),
			array('enrollment_status, batch_group, session, department_id, semester, date_of_deposit, total_deposit, full_free, bank_info,batch_ref_course_pk, batch_ref', 'required','on'=>'insert'),
			array('student_id,', 'unique'),
			array('date_of_deposit', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),

			array('total_deposit,semester, session', 'numerical'),
			array('total_deposit', 'depositeValidators','on'=>'insert'),
			
			array('student_email', 'email'),
			array('student_id', 'length', 'max'=>16),
			array('student_name, student_father_name, student_mother_name, student_email, occupation, admission_reference, student_image, student_fb_id', 'length', 'max'=>128),
			array('student_nationality, student_pob, student_contact', 'length', 'max'=>32),
			array('student_gender', 'length', 'max'=>6),
			array('student_profession', 'length', 'max'=>64),
			array('student_blood_group', 'length', 'max'=>3),
			array('student_present_address, student_permanent_address, student_dob,student_qualification, occupation, student_alternate_contact, student_reason_of_photography, student_expectation, batch_ref_course_pk,batch_ref_course_pk,course_semester_lebel,semester', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('student_id,student_ref_batch_pk, student_name, student_father_name,roll_no, session_id, batch_group,  student_mother_name, student_present_address,occupation, batch_ref_course_pk, student_permanent_address, student_nationality, student_gender, student_dob, student_pob, student_profession, student_email, student_fb_id, student_contact, student_blood_group, student_qualification, student_alternate_contact, student_reason_of_photography, student_expectation, student_pk, department_id,course_semester_lebel,semester, batch_ref', 'safe', 'on'=>'search'),
		);
	}
	

	public function depositeValidators()
	{
	  
	  $session=$this->session;
	  $course_id=$this->batch_ref_course_pk;
	  $enrollment_status=$this->enrollment_status;
	  $full_free=$this->full_free;
	  
		$connection=Yii::app()->db;
        
        
		
	  $command=$connection->createCommand("SELECT SUM(collection_amount) FROM collection_head where session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='1')");
	  
	  $amount = $command->queryScalar();
	  //echo "session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='0')";
	  $monthly_charge=CollectionHead::model()->find("session='$session' and course='$course_id' and student_type='$enrollment_status' and ( apply_on_month='0')");
	 // echo $monthly_charge->collection_amount;
	  
	  if($full_free=="No")
		{	
			if($monthly_charge) $amount=$amount+(3*$monthly_charge->collection_amount);
			
		}
		
      			
					
	  
		$labels = $this->attributeLabels(); // Getting labels of the attributes
		if($this->total_deposit<$amount)
		{
		   $this->addError("total_deposit", $labels["total_deposit"]." less than minimum amount ".$amount.".");
		}
		// More dependent on type can be written here
	  
	}


	public function getStImage($image)
	{
	return Yii::app()->request->getBaseUrl(TRUE)."/images/student/".$image;
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'batch' => array(self::BELONGS_TO, 'Batch', 'student_ref_batch_pk'),
			'EnrollmentInfo' => array(self::HAS_ONE, 'StudentEnrollmentInfo', 'student_pk'),
			'EnrollmentInfoAll' => array(self::HAS_MANY, 'StudentEnrollmentInfo', 'student_pk','order'=>'session DESC'),
			
			'EnrollmentInfoLast' => array(self::HAS_ONE, 'StudentEnrollmentInfo', 'student_pk','order'=>'session DESC'),	
			
			
			
                        'StudentDues' => array(self::HAS_MANY, 'StudentDues', 'student_pk'),
                        'StudentFine' => array(self::HAS_MANY, 'StudentFine', 'student_pk'),
                        'StudentRemaining'=>array(self::HAS_ONE, 'StudentRemaining', 'student_pk'),
			'EnrollmentInfoPresent' => array(self::HAS_ONE, 'StudentEnrollmentInfo', 'student_pk','on'=>'EnrollmentInfoPresent.session='.Bndate::get_year(date("Y-m-d"))),	
			'EnrollmentInfoPast' => array(self::HAS_MANY, 'StudentEnrollmentInfo', 'student_pk','on'=>'EnrollmentInfoPast.session!='.Bndate::get_year(date("Y-m-d"))),			
						
		);
	}

	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		'comment' => Yii::t('core','Comment'),
		'full_free' => Yii::t('core','Full Free'),
			'student_id' => Yii::t('core','ID'),
			'student_name' => Yii::t('core','Name'),
			'student_father_name' => Yii::t('core',"Father's Name"),
			'student_mother_name' => Yii::t('core',"Mother's Name"),
			'student_present_address' => Yii::t('core','Present Address'),
			'student_permanent_address' => Yii::t('core','Permanent Address'),
			'student_nationality' => Yii::t('core','Nationality'),
			'student_gender' => Yii::t('core','Gender'),
			'student_dob' => Yii::t('core','Date of Birth'),
			'student_pob' => Yii::t('core','Place of Birth'),
			'student_profession' => Yii::t('core','Profession'),
			'student_email' => Yii::t('core','Email'),
			'student_fb_id' => Yii::t('core','Facebook ID'),
			'student_contact' => Yii::t('core','Contact'),
			'student_blood_group' => Yii::t('core','Blood Group'),
			'student_qualification' => Yii::t('core','Qualification'),
			'student_alternate_contact' => Yii::t('core','Alternate Contact'),
			'student_reason_of_photography' => Yii::t('core','Reason Of Photography'),
			'student_expectation' => Yii::t('core','Expectation from Pahtshala'),
			'student_pk' => Yii::t('core','Student#'),
			'student_ref_batch_pk' => Yii::t('core','Batch'),
			'semester' => Yii::t('core','Semester'),
			'session' => Yii::t('core','Session'),
			'batch_group' => Yii::t('core','Batch Group'),
			'batch_ref_course_pk' => Yii::t('core','Course'),
			'batch_ref' => Yii::t('core','Batch'),
			'department_id'=>Yii::t('core','Department'),

			'total_deposit'=>Yii::t('core','Total Deposit'),
			'date_of_deposit'=>Yii::t('core','Deposit Date'),
			'bank_info'=>Yii::t('core','Bank Info'),
			'enrollment_status'=>Yii::t('core','Enrollment Status'),
			'occupation'=>Yii::t('core','Occupation'),
			'admission_reference'=>Yii::t('core','Admission Reference'),
			'course_semester_lebel'=>Yii::t('core','Course Semester Lebel'),
			'card_type'=>Yii::t('core','Card Type'),
			'roll_no_start'=>Yii::t('core','Roll No Start'),
			'roll_no_end'=>Yii::t('core','Roll No End'),
			'session_id'=>Yii::t('core','Session'),
			'student_image'=>Yii::t('core','Image'),
			'roll_no'=>Yii::t('core','Roll No'),
			
			
			

		);
	}

	
	public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.student_id',$this->student_id,true);
		$criteria->compare('student_name',$this->student_name,true);
		$criteria->compare('student_father_name',$this->student_father_name,true);
		$criteria->compare('student_mother_name',$this->student_mother_name,true);
		$criteria->compare('student_present_address',$this->student_present_address,true);
		$criteria->compare('student_permanent_address',$this->student_permanent_address,true);
		$criteria->compare('student_nationality',$this->student_nationality,true);
		$criteria->compare('student_gender',$this->student_gender,true);
		$criteria->compare('student_dob',$this->student_dob,true);
		$criteria->compare('student_pob',$this->student_pob,true);
		$criteria->compare('student_profession',$this->student_profession,true);
		$criteria->compare('student_email',$this->student_email,true);
		$criteria->compare('student_fb_id',$this->student_fb_id,true);
		$criteria->compare('student_contact',$this->student_contact,true);
		$criteria->compare('student_blood_group',$this->student_blood_group,true);
		$criteria->compare('student_qualification',$this->student_qualification,true);
		$criteria->compare('student_alternate_contact',$this->student_alternate_contact,true);
		$criteria->compare('student_reason_of_photography',$this->student_reason_of_photography,true);
		$criteria->compare('student_expectation',$this->student_expectation,true);
		$criteria->compare('student_pk',$this->student_pk,false);
		//$criteria->compare('student_ref_batch_pk',$this->student_ref_batch_pk,false);
		//$criteria->compare('semester',$this->semester,false);
		$criteria->compare('session',$this->session,false);

		/*$criteria->together = true;
		$criteria->with=array('batch');
		$criteria->x('batch.batch_id',$this->student_ref_batch_pk,true);
		*/
		
		
		$criteria->together = true;
		$criteria->with=array('EnrollmentInfoLast','EnrollmentInfoLast.course','EnrollmentInfoLast.department','EnrollmentInfoLast.batchgroup', 'EnrollmentInfoLast.batch','EnrollmentInfoLast.semesterLevel');

		$criteria->compare('EnrollmentInfoLast.session',$this->session_id,true);
		
		$criteria->compare('course_name',$this->batch_ref_course_pk,true);
		
		$criteria->compare('student_expectation',$this->student_expectation,true);

		$criteria->compare('department_name',$this->department_id,true);
		
		
		//$criteria->compare('roll_no',$this->roll_no,false);
		
		
		if ($this->roll_no) {
                                if (strpos($this->roll_no,',') !==false) {
                                     
                                            //echo 'EnrollmentInfoLast.roll_no in ('.$this->roll_no.')'; die();
											$criteria->condition='EnrollmentInfoLast.roll_no in ('.$this->roll_no.')';
                                             
                                } 
                                elseif (strpos($this->roll_no,'-') !==false) {
                                     $st_ids = explode('-',$this->roll_no);
                                     
									 //echo $st_ids[0]." ".$st_ids[1]; die();
                                         
                                        $criteria->condition='EnrollmentInfoLast.roll_no >= '.$st_ids[0].' and EnrollmentInfoLast.roll_no <= '.$st_ids[1];
                                            
                                    
                                }
                                
                                else {
                                  $criteria->compare('roll_no',$this->roll_no,false);
                                }
                    }
					else {
                                  $criteria->compare('roll_no',$this->roll_no,false);
                                }
		
		/*if ($this->roll_no) {
                                if (strpos($this->roll_no,',') !==false) {
                                     $st_ids = explode(',',$this->roll_no);               
                                     foreach($st_ids as $st_id) {
                                             $criteria->compare('roll_no',$st_id,true,'OR');
                                             //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                     } 
                                } 
                                elseif (strpos($this->roll_no,'-') !==false) {
                                     $st_ids = explode('-',$this->roll_no);
                                     if(count($st_ids)==2)
                                     {
                                         
                                        if($st_ids[0]<$st_ids[1])
                                        { 
                                           } 
                                            for ($r=$st_ids[0];$r<=$st_ids[1];$r++)

                                            {
                                                   $criteria->compare('roll_no',$r,true,'OR');
                                                   //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                        }
                                     }
                                }
                                
                                else {
                                  $criteria->compare('roll_no',$this->roll_no,true);
                                }
                    }*/
		
		$criteria->compare('batch.batch_id',$this->student_ref_batch_pk,true);
		
		$criteria->compare('batchgroup.group_name',$this->batch_group,true);

		$criteria->compare('semesterLevel.lebel',$this->semester,true);

		//$criteria->compare('batch.batch_id',$this->batch_ref,true);

		if(isset($this->student_image))
		{
			if($this->student_image=="Yes")
			$criteria->condition="student_image is not null";
			if($this->student_image=="No")
			$criteria->condition="student_image is null";
			
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>40)
		));
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

		$criteria->compare('t.student_id',$this->student_id,true);
		$criteria->compare('student_name',$this->student_name,true);
		$criteria->compare('student_father_name',$this->student_father_name,true);
		$criteria->compare('student_mother_name',$this->student_mother_name,true);
		$criteria->compare('student_present_address',$this->student_present_address,true);
		$criteria->compare('student_permanent_address',$this->student_permanent_address,true);
		$criteria->compare('student_nationality',$this->student_nationality,true);
		$criteria->compare('student_gender',$this->student_gender,true);
		$criteria->compare('student_dob',$this->student_dob,true);
		$criteria->compare('student_pob',$this->student_pob,true);
		$criteria->compare('student_profession',$this->student_profession,true);
		$criteria->compare('student_email',$this->student_email,true);
		$criteria->compare('student_fb_id',$this->student_fb_id,true);
		$criteria->compare('student_contact',$this->student_contact,true);
		$criteria->compare('student_blood_group',$this->student_blood_group,true);
		$criteria->compare('student_qualification',$this->student_qualification,true);
		$criteria->compare('student_alternate_contact',$this->student_alternate_contact,true);
		$criteria->compare('student_reason_of_photography',$this->student_reason_of_photography,true);
		$criteria->compare('student_expectation',$this->student_expectation,true);
		$criteria->compare('student_pk',$this->student_pk,false);
		//$criteria->compare('student_ref_batch_pk',$this->student_ref_batch_pk,false);
		//$criteria->compare('semester',$this->semester,false);
		$criteria->compare('session',$this->session,false);

		/*$criteria->together = true;
		$criteria->with=array('batch');
		$criteria->x('batch.batch_id',$this->student_ref_batch_pk,true);
		*/
		
		/*
		$criteria->together = true;
		$criteria->with=array('EnrollmentInfoLast','EnrollmentInfoLast.course','EnrollmentInfoLast.department','EnrollmentInfoLast.batchgroup', 'EnrollmentInfoLast.batch','EnrollmentInfoLast.semesterLevel');

		$criteria->compare('EnrollmentInfoLast.session',$this->session_id,true);
		
		$criteria->compare('course_name',$this->batch_ref_course_pk,true);
		
		$criteria->compare('student_expectation',$this->student_expectation,true);

		$criteria->compare('department_name',$this->department_id,true);
		
		
		//$criteria->compare('roll_no',$this->roll_no,false);
		
		
		if ($this->roll_no) {
                                if (strpos($this->roll_no,',') !==false) {
                                     
                                            //echo 'EnrollmentInfoLast.roll_no in ('.$this->roll_no.')'; die();
											$criteria->condition='EnrollmentInfoLast.roll_no in ('.$this->roll_no.')';
                                             
                                } 
                                elseif (strpos($this->roll_no,'-') !==false) {
                                     $st_ids = explode('-',$this->roll_no);
                                     
									 //echo $st_ids[0]." ".$st_ids[1]; die();
                                         
                                        $criteria->condition='EnrollmentInfoLast.roll_no >= '.$st_ids[0].' and EnrollmentInfoLast.roll_no <= '.$st_ids[1];
                                            
                                    
                                }
                                
                                else {
                                  $criteria->compare('roll_no',$this->roll_no,false);
                                }
                    }
					else {
                                  $criteria->compare('roll_no',$this->roll_no,false);
                                }
		
		/*if ($this->roll_no) {
                                if (strpos($this->roll_no,',') !==false) {
                                     $st_ids = explode(',',$this->roll_no);               
                                     foreach($st_ids as $st_id) {
                                             $criteria->compare('roll_no',$st_id,true,'OR');
                                             //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                     } 
                                } 
                                elseif (strpos($this->roll_no,'-') !==false) {
                                     $st_ids = explode('-',$this->roll_no);
                                     if(count($st_ids)==2)
                                     {
                                         
                                        if($st_ids[0]<$st_ids[1])
                                        { 
                                           } 
                                            for ($r=$st_ids[0];$r<=$st_ids[1];$r++)

                                            {
                                                   $criteria->compare('roll_no',$r,true,'OR');
                                                   //I also tried things like $criteria->compare('city',$c,true,"AND",true);
                                        }
                                     }
                                }
                                
                                else {
                                  $criteria->compare('roll_no',$this->roll_no,true);
                                }
                    }*/
		/*
		$criteria->compare('batch.batch_id',$this->student_ref_batch_pk,true);
		
		$criteria->compare('batchgroup.group_name',$this->batch_group,true);

		$criteria->compare('semesterLevel.lebel',$this->semester,true);

		//$criteria->compare('batch.batch_id',$this->batch_ref,true);*/

		if(isset($this->student_image))
		{
			if($this->student_image=="Yes")
			$criteria->condition="student_image is not null";
			if($this->student_image=="No")
			$criteria->condition="student_image is null";
			
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>40)
		));
	}
}