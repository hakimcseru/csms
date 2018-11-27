<?php

/**
 * This is the model class for table "certificate_record".
 *
 * The followings are the available columns in table 'certificate_record':
 * @property integer $id
 * @property string $received_date
 * @property string $received_by
 * @property integer $student_id
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $session_id
 * @property integer $batch_id
 * @property integer $batch_group_id
 */
class CertificateRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CertificateRecord the static model class
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
		return 'certificate_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('received_date, received_by, student_id, course_id, department_id, session_id, batch_id, batch_group_id', 'required'),
			array('student_id, course_id, department_id, session_id, batch_id, batch_group_id', 'numerical', 'integerOnly'=>true),
			array('received_by', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, received_date, received_by, student_id, course_id, department_id, session_id, batch_id, batch_group_id', 'safe', 'on'=>'search'),
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
			
			'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
		
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group_id'),
			'student' => array(self::BELONGS_TO, 'Student', 'student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core','ID'),
			'received_date' => Yii::t('core','Received Date'),
			'received_by' => Yii::t('core','Received By'),
			'student_id' => Yii::t('core','Student ID'),
			'course_id' => Yii::t('core','Course'),
			'department_id' => Yii::t('core','Department'),
			'session_id' => Yii::t('core','Session'),
			'batch_id' => Yii::t('core','Batch'),
			'batch_group_id' => Yii::t('core','Batch Group'),
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
		$criteria->compare('received_date',$this->received_date,true);
		$criteria->compare('received_by',$this->received_by,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('department_id',$this->department_id,true);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('batch_id',$this->batch_id,true);
		//$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->together = true;
		$criteria->with=array('batchgroup');
		$criteria->compare('batchgroup.group_name',$this->batch_group_id,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}