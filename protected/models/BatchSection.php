<?php

/**
 * This is the model class for table "batch_section".
 *
 * The followings are the available columns in table 'batch_section':
 * @property integer $id
 * @property integer $batch_group_id
 * @property string $section_name
 * @property integer $start_role
 * @property integer $end_role
 * @property integer $session_id
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $batch_id
 */
class BatchSection extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BatchSection the static model class
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
		return 'batch_section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_group_id, section_name, start_role, end_role, session_id, course_id, department_id, batch_id', 'required'),
			array('batch_group_id, start_role, end_role, session_id, course_id, department_id, batch_id', 'numerical', 'integerOnly'=>true),
			array('section_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, batch_group_id, section_name, start_role, end_role, session_id, course_id, department_id, batch_id', 'safe', 'on'=>'search'),
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
		'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
		'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group_id'),
		'department'=>array(self::BELONGS_TO, 'Department', 'department_id'),
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
			'batch_group_id' => Yii::t('core','Batch Group'),
			'section_name' => Yii::t('core','Section Name'),
			'start_role' => Yii::t('core','Roll No Start'),
			'end_role' => Yii::t('core','Roll No End'),
			'session_id' => Yii::t('core','Session'),
			'course_id' => Yii::t('core','Course'),
			'department_id' => Yii::t('core','Department'),
			'batch_id' => Yii::t('core','Batch'),
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
		//$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('section_name',$this->section_name,true);
		$criteria->compare('start_role',$this->start_role);
		$criteria->compare('end_role',$this->end_role);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('department_id',$this->department_id);
		//$criteria->compare('batch_id',$this->batch_id);
		
		$criteria->together = true;
		$criteria->with=array('batchgroup','batch');
		$criteria->compare('batch.batch_id',$this->batch_id,true);
		$criteria->compare('batchgroup.group_name',$this->batch_group_id,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}