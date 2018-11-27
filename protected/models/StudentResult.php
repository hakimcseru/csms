<?php

/**
 * This is the model class for table "student_result".
 *
 * The followings are the available columns in table 'student_result':
 * @property integer $id
 * @property integer $session
 * @property integer $course
 * @property integer $department
 * @property integer $subject
 * @property integer $student_pk
 * @property integer $student_id
 * @property double $full_marks
 * @property string $result
 * @property integer $semester
 * @property integer $batch_id
 * @property integer $batch_group
 */
class StudentResult extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentResult the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session, course, department, subject, student_id, semester', 'required'),
			array('session, course, department,examseting_id, subject, student_pk, student_id, semester, batch_id, batch_group', 'numerical', 'integerOnly'=>true),
			//array('full_marks', 'numerical'),
			array('full_marks, result', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session, course, department, subject, student_pk, examseting_id,student_id, full_marks, result, semester, batch_id, batch_group', 'safe', 'on'=>'search'),
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
		'examsetting' => array(self::BELONGS_TO, 'Examsetting', 'examseting_id'),
		 'courses' => array(self::BELONGS_TO, 'Course', 'course'),
			'student' => array(self::BELONGS_TO, 'Student', 'student_pk'),
			'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
			
			'departments' => array(self::BELONGS_TO, 'Department', 'department'),
			'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group'),

			
			
			'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester','course_id'=>'course')),
		);
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
			'student_pk' => 'Student Pk',
			'student_id' => 'Student',
			'full_marks' => 'Full Marks',
			'result' => 'Result',
			'semester' => 'Semester',
			'batch_id' => 'Batch',
			'batch_group' => 'Batch Group',
			'examseting_id' => 'Exam seting',
		);
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

		$criteria->together = true;
		$criteria->with=array('courses','student','batch','departments','batchgroup','semesterLevel');
		
		$criteria->compare('courses.course_name',$this->course,true);

		$criteria->compare('batch.batch_id',$this->batch_id,true);
		$criteria->compare('departments.department_name',$this->department,true);

		$criteria->compare('batchgroup.group_name',$this->batch_group,true);
		//$criteria->compare('batchgroup.group_name',$this->batch_group,true);

		$criteria->compare('student.student_name',$this->student_pk,true);
                
		$criteria->compare('semesterLevel.lebel',$this->semester,false);
		
		
		$criteria->compare('id',$this->id);
		$criteria->compare('session',$this->session);
		//$criteria->compare('course',$this->course);
		//$criteria->compare('department',$this->department);
		$criteria->compare('subject',$this->subject);
		//$criteria->compare('student_pk',$this->student_pk);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('full_marks',$this->full_marks);
		$criteria->compare('result',$this->result,true);
		//$criteria->compare('semester',$this->semester);
		//$criteria->compare('batch_id',$this->batch_id);
		//$criteria->compare('batch_group',$this->batch_group);
		$criteria->compare('examseting_id',$this->examseting_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}