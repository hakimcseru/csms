<?php

/**
 * This is the model class for table "course_subject".
 *
 * The followings are the available columns in table 'course_subject':
 * @property string $course_subject_pk
 * @property string $course_subject_ref_course_pk
 * @property string $course_subject_ref_subject_pk
 * @property integer $course_subject_semester_no
 *
 * The followings are the available model relations:
 * @property Course $course
 * @property Subject $subject
 */
class CourseSubject extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseSubject the static model class
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
		return 'course_subject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('course_subject_ref_course_pk, pass_mark, full_mark, course_subject_department_id, course_subject_ref_subject_pk', 'required'),
			
			array('course_subject_ref_course_pk, course_subject_ref_subject_pk, course_subject_semester_no, course_subject_department_id, pass_mark, full_mark', 'safe'),
			
			//array('course_subject_ref_course_pk, course_subject_ref_subject_pk', 'unique'),
			array('course_subject_semester_no', 'numerical', 'integerOnly'=>true),
			array('course_subject_ref_course_pk, course_subject_ref_subject_pk, course_subject_department_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('course_subject_pk, course_subject_ref_course_pk,course_subject_department_id, course_subject_ref_subject_pk, course_subject_semester_no', 'safe', 'on'=>'search'),
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
			'subject' => array(self::BELONGS_TO, 'Subject', 'course_subject_ref_subject_pk'),
			'course' => array(self::BELONGS_TO, 'Course', 'course_subject_ref_course_pk'),
			'department'=>array(self::BELONGS_TO, 'Department', 'course_subject_department_id'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'course_subject_pk' => Yii::t('core','Course Subject Pk'),
			'course_subject_ref_course_pk' => Yii::t('core','Course'),
			'course_subject_ref_subject_pk' => Yii::t('core','Subject'),
			'course_subject_semester_no' => Yii::t('core','Semester'),
			'course_subject_department_id'=>Yii::t('core','Department'),
			'pass_mark'=>Yii::t('core','Pass Mark'),
			'full_mark'=>Yii::t('core','Full Mark'),
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

		$criteria->compare('course_subject_pk',$this->course_subject_pk,true);
		$criteria->compare('course_subject_ref_course_pk',$this->course_subject_ref_course_pk,true);
		$criteria->compare('course_subject_ref_subject_pk',$this->course_subject_ref_subject_pk,true);
		$criteria->compare('course_subject_semester_no',$this->course_subject_semester_no);
		$criteria->compare('course_subject_department_id',$this->course_subject_department_id);
		$criteria->compare('pass_mark',$this->pass_mark);
		$criteria->compare('full_mark',$this->full_mark);
		

		$criteria->with = array('course', 'subject');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
//				'attributes'=>array(
//					'author_search'=>array(
//						'asc'=>'author.username',
//						'desc'=>'author.username DESC',
//					),
//					'*',
//				),
				'defaultOrder'=> array(
					'course_subject_semester_no ASC',
					'course_name ASC',
				)
			),
		));
	}

	public function beforeValidate()
	{ /*
		$exist = CourseSubject::model()->findByAttributes(array(
			'course_subject_ref_course_pk'=>  $this->course_subject_ref_course_pk,
			'course_subject_ref_subject_pk'=> $this->course_subject_ref_subject_pk,
		));

		if($exist && $exist->course_subject_pk != $this->course_subject_pk)
		{
			$this->addError('course_subject_ref_course_pk', 'This subject is already under this course');
		}
		return parent::beforeValidate();
		*/
		return parent::beforeValidate();
	}
}