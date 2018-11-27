<?php

/**
 * This is the model class for table "examsetting".
 *
 * The followings are the available columns in table 'examsetting':
 * @property integer $id
 * @property integer $session
 * @property integer $course
 * @property integer $department
 * @property integer $subject
 * @property string $mark_type
 * @property integer $teacher
 */
class Examsetting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Examsetting the static model class
	 */
	 
	 public $teacher;
	
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'examsetting';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session,semester,batch_id,batch_group, course, department, lock,  subject, mark_type', 'required'),
			array('session,batch_id,batch_group, course,semester, department, subject, pass_mark,full_mark', 'numerical', 'integerOnly'=>true),
			array('mark_type', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session,batch_id,batch_group,lock, semester,course, department, subject,pass_mark,full_mark, mark_type', 'safe', 'on'=>'search'),
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
		
		'teacher' => array(self::HAS_MANY, 'ExamsettingFacultymember', 'examsetting_id'),
		'teacher2' => array(self::HAS_MANY, 'ExamsettingFacultymember', 'examsetting_id'),
		
		 'coursec' => array(self::BELONGS_TO, 'Course', 'course'),
			'subjects' => array(self::BELONGS_TO, 'Subject', 'subject'),
		'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester','course_id'=>'course')),
		//'subjects' => array(self::HAS_ONE, 'Subject', array('semester_id' => 'semester','course_id'=>'course') ),
			
			'departments' => array(self::BELONGS_TO, 'Department', 'department'),
		'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
		'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group'),
		
				
		
		);
	}

	
	public function getTeacherNames($separator='<br>')
	{
		$names = array();
		foreach($this->teacher as $teacher) {
			$names[] = $teacher->member_name;
		}
		return implode($separator, $names);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'session' => 'Session',
			'course' => 'Course',
			'department' => 'Department',
			'subject' => 'Subject',
			'mark_type' => 'Mark Type',
			'semester' => 'Semester',
			'batch_id'=>'Batch',
			'batch_group'=>'Group',
			'pass_mark'=>'Pass Marks',
			'full_mark'=>'Full Marks',
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function allteacher($mod) 
	{

	
	$st="";
	//print_r($mod->teacher); 
	$modd=ExamsettingFacultymember::model()->findAll('examsetting_id='.$mod->id);
	
	if(isset($modd))
	{
	foreach($modd as $teacher):
	
	 $st.=$teacher->facultyMember->member_name.",  ";
	
	endforeach;
	}
	return $st;
	
	}
	 
	 
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->together = true;
		$criteria->with=array('batchgroup','semesterLevel','coursec','subjects','departments','batch');

		$criteria->compare('id',$this->id);
		$criteria->compare('session',$this->session);
		$criteria->compare('coursec.course_name',$this->course);
		$criteria->compare('departments.department_name',$this->department);
		$criteria->compare('subjects.subject_name',$this->subject);
		$criteria->compare('mark_type',$this->mark_type,true);
		$criteria->compare('batch.batch_id',$this->batch_id);
		$criteria->compare('batchgroup.group_name',$this->batch_group,true);
		$criteria->compare('semesterLevel.lebel',$this->semester,false);
		//$criteria->compare('semester',$this->semester);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>40),
		));
	}
}