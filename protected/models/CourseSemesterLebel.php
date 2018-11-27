<?php

/**
 * This is the model class for table "course_semester_lebel".
 *
 * The followings are the available columns in table 'course_semester_lebel':
 * @property integer $id
 * @property integer $course_id
 * @property integer $semester_id
 * @property string $lebel
 */
class CourseSemesterLebel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseSemesterLebel the static model class
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
		return 'course_semester_lebel';
	}

	public function semesterLebel($c_id,$s_id,$con=0)
	{
         //echo $c_id." s ".$s_id." e ".$con;
	 $lebel=CourseSemesterLebel::model()->find('semester_id='.$s_id.' and course_id='.$c_id);
	 if(isset($lebel->lebel) && $con==0) return $lebel->lebel;
         elseif(isset($lebel->lebel) && $con==1) return $lebel->lebel.' ('.$s_id.')';
	 else return $s_id;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, semester_id, lebel', 'required'),
			array('course_id, semester_id', 'numerical', 'integerOnly'=>true),
			array('lebel', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, course_id, semester_id, lebel', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core','ID'),
			'course_id' => Yii::t('core','Course'),
			'semester_id' => Yii::t('core','Semester'),
			'lebel' => Yii::t('core','Lebel'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('semester_id',$this->semester_id);
		$criteria->compare('lebel',$this->lebel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}