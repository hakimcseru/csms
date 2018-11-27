<?php

/**
 * This is the model class for table "subject".
 *
 * The followings are the available columns in table 'subject':
 * @property string $subject_code
 * @property string $subject_name
 * @property string $subject_pk
 *
 * The followings are the available model relations:
 * @property Course[] $courses
 */
class Subject extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subject the static model class
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
		return 'subject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject_code, subject_name', 'required'),
			array('subject_code', 'length', 'max'=>16),
			array('subject_name', 'length', 'max'=>128),
			array('syllabus', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('subject_code, subject_name, syllabus, subject_pk', 'safe', 'on'=>'search'),
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
			'courses' => array(self::MANY_MANY, 'Course', 'course_subject(course_subject_ref_subject_pk, course_subject_ref_course_pk)'),
			'class' => array(self::HAS_MANY, 'ClassModel', 'class_ref_subject_pk'),
			'department' => array(self::MANY_MANY, 'CourseSubject', 'course_subject_ref_subject_pk'),
			'course_subject' => array(self::HAS_MANY, 'CourseSubject', 'course_subject_ref_subject_pk'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'subject_code' => Yii::t('core','Subject Code'),
			'subject_name' => Yii::t('core','Subject Name'),
			'subject_pk' => Yii::t('core','Subject Pk'),
			'syllabus' => Yii::t('core','Syllabus'),

		);
	}
	
	
	public function coursss()
	{
		$sd="";
		foreach($this->course_subject as $ff):
		
		$sd.=$ff->course->course_name.', '.$ff->department->department_name.', '.CourseSemesterLebel::semesterLebel($ff->course_subject_ref_course_pk,$ff->course_subject_semester_no,0).'<br />';
		
		endforeach;
		return $sd;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		//echo "<script>alert('adsa')</script>";
		$criteria=new CDbCriteria;

		$criteria->compare('subject_code',$this->subject_code,true);
		$criteria->compare('subject_name',$this->subject_name,true);
		$criteria->compare('subject_pk',$this->subject_pk,true);
		$criteria->compare('syllabus',$this->syllabus,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}