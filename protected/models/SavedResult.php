<?php

/**
 * This is the model class for table "saved_result".
 *
 * The followings are the available columns in table 'saved_result':
 * @property string $id
 * @property integer $session_id
 * @property string $course
 * @property string $department
 * @property string $semester
 * @property string $batch_group
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $semester_id
 * @property integer $batch_group_id
 * @property integer $roll_no
 * @property string $name
 * @property string $student_id
 * @property double $total_number
 * @property string $result
 * @property string $position
 * @property string $published_date
 * @property string $saved_date
 * @property integer $saved_by
 */
class SavedResult extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SavedResult the static model class
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
		return 'saved_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, course, department, semester, batch_group, course_id, department_id, semester_id, batch_group_id, roll_no,batch_id, name, student_id, total_number, published_date, saved_date, saved_by', 'required'),
			array('session_id, course_id, batch_id, department_id, semester_id, batch_group_id, roll_no, saved_by', 'numerical', 'integerOnly'=>true),
			//array('total_number', 'numerical'),
			array('course, department, semester, batch_group, name, student_id, result, position', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session_id, course, batch_id, department, semester, batch_group, course_id, department_id, semester_id, batch_group_id, roll_no, name, student_id, total_number, result, position, published_date, saved_date, saved_by', 'safe', 'on'=>'search'),
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
		'resultsubject' => array(self::HAS_MANY, 'SavedResultSubject', 'saved_result_id'),
		'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
		 'sem'=>array(self::BELONGS_TO, 'CourseSemesterLebel', 'semester_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'session_id' => 'Session',
			'course' => 'Course',
			'department' => 'Department',
			'semester' => 'Semester',
			'batch_group' => 'Batch Group',
			'course_id' => 'Course',
			'department_id' => 'Department',
			'semester_id' => 'Semester',
			'batch_group_id' => 'Batch Group',
			'roll_no' => 'Roll No',
			'name' => 'Name',
			'student_id' => 'Student',
			'total_number' => 'Total Number',
			'result' => 'Result',
			'position' => 'Position',
			'published_date' => 'Published Date',
			'saved_date' => 'Saved Date',
			'saved_by' => 'Saved By',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('course',$this->course,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('batch_group',$this->batch_group,true);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('semester_id',$this->semester_id);
		$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('roll_no',$this->roll_no);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('total_number',$this->total_number);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('published_date',$this->published_date,true);
		$criteria->compare('saved_date',$this->saved_date,true);
		$criteria->compare('saved_by',$this->saved_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
		public function search3()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('course',$this->course,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('batch_group',$this->batch_group,true);
		/*$criteria->compare('course_id',$this->course_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('semester_id',$this->semester_id);
		$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('roll_no',$this->roll_no);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('total_number',$this->total_number);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('published_date',$this->published_date,true);
		$criteria->compare('saved_date',$this->saved_date,true);
		$criteria->compare('saved_by',$this->saved_by);*/
$criteria->distinct=true;
		$criteria->select = 'session_id, course, department, semester, batch_id, batch_group';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => false,
		));
	}
	
	
	public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('course',$this->course,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('semester',$this->semester,true);
		$criteria->compare('batch_group',$this->batch_group,true);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('semester_id',$this->semester_id);
		$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('roll_no',$this->roll_no);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('total_number',$this->total_number);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('published_date',$this->published_date,true);
		$criteria->compare('saved_date',$this->saved_date,true);
		$criteria->compare('saved_by',$this->saved_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => false,
		));
	}
}