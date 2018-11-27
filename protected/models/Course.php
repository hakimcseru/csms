<?php

/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property string $course_pk
 * @property string $course_name
 * @property integer $semester
 *
 * The followings are the available model relations:
 * @property Subject[] $subjects
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Course the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public $semester_lebel;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_name, semester', 'required'),
			array('semester', 'numerical', 'integerOnly'=>true),
			array('course_name', 'unique'),
			array('course_name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('course_pk, course_name, semester', 'safe', 'on'=>'search'),
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
			'departments' => array(self::HAS_MANY, 'CourseDepartment', 'course_id'),
			'batches' => array(self::HAS_MANY, 'Batch', 'batch_ref_course_pk'),
			'students' => array(self::HAS_MANY, 'Student', array('batch_pk'=>'student_ref_batch_pk'), 'through'=>'batches'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'course_pk' => Yii::t('core','Course')." ".Yii::t('core','ID'),
			'course_name' => Yii::t('core','Course'),
			'semester' => Yii::t('core','Semester'),
			'semester_lebel'=>Yii::t('core','Semester Lebel'),
		);
	}

	public function allSemisterLebelsArray($course_id, $No_of_semester)
	{

		if($No_of_semester>0)
		{
			$str="";
			for($i=1;$i<=$No_of_semester;$i++)
			{

				if($i==1)
				$str.="semester_id=".$i;

				else $str.=" or semester_id=".$i;


			}

			//echo $str; die();

			$csl=CourseSemesterLebel::model()->findAll("course_id=".$course_id." and ($str)" );

		  //count($csl); die();

			return $csl;
		}

		else return  false;
	}


	public function allSemisterLebelsString($course_id, $No_of_semester)
	{


			$we=$this->allSemisterLebelsArray($course_id, $No_of_semester);

			if($we)
			{
			$dd="";
			foreach($we as $cs):

			$dd.=$cs->lebel."<br/>";

			endforeach;
			return  $dd;
			}

		return  FALSE;
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

		$criteria->compare('course_pk',$this->course_pk,true);
		$criteria->compare('course_name',$this->course_name,true);
		$criteria->compare('semester',$this->semester);

		$criteria->compare('department_id',$this->department_id);



		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}