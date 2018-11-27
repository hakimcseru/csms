<?php

/**
 * This is the model class for table "class".
 *
 * The followings are the available columns in table 'class':
 * @property string $class_pk
 * @property string $class_ref_room_pk
 * @property string $class_ref_room_no
 * @property string $class_start_date
 * @property string $class_end_date
 * @property string $class_start_time
 * @property string $class_end_time
 * @property string $class_status
 * @property string $class_days_on_week
 * @property string $class_ref_batch_pk
 * @property string $class_ref_batch_id
 * @property string $class_ref_subject_pk
 * @property string $class_ref_subject_name
 * @property integer $class_semester
 */
class ClassModel extends CActiveRecord
{
	public $ignoreClash = false;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassModel the static model class
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
		return 'class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_ref_batch_pk, class_ref_batch_id, class_ref_subject_pk, class_ref_subject_name', 'required'),
			array('class_ref_room_pk, class_ref_batch_pk, class_ref_subject_pk, class_ref_subject_name', 'length', 'max'=>20),
			array('class_ref_room_no, class_ref_batch_id', 'length', 'max'=>32),
			array('class_status', 'length', 'max'=>16),
			array('class_days_on_week', 'length', 'max'=>128),
			array('class_start_date, class_end_date, class_start_time, class_end_time, class_semester', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_pk, class_ref_room_pk, class_ref_room_no, class_start_date, class_end_date, class_start_time, class_end_time, class_status, class_days_on_week, class_ref_batch_pk, class_ref_batch_id, class_ref_subject_pk, class_ref_subject_name, class_semester', 'safe', 'on'=>'search'),
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
			'batch' => array(self::BELONGS_TO, 'Batch', 'class_ref_batch_pk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_pk' => Yii::t('core','Class#'),
			'class_ref_room_pk' => Yii::t('core','Room Pk'),
			'class_ref_room_no' => Yii::t('core','Room#'),
			'class_start_date' => Yii::t('core','Start Date'),
			'class_end_date' => Yii::t('core','End Date'),
			'class_start_time' => Yii::t('core','Start Time'),
			'class_end_time' => Yii::t('core','End Time'),
			'class_status' => Yii::t('core','Status'),
			'class_days_on_week' => Yii::t('core','Days'),
			'class_ref_batch_pk' => Yii::t('core','Batch Pk'),
			'class_ref_batch_id' => Yii::t('core','Batch#'),
			'class_ref_subject_pk' => Yii::t('core','Subject Pk'),
			'class_ref_subject_name' => Yii::t('core','Subject'),
			'class_semester' => Yii::t('core','Semester'),
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

		$criteria->compare('class_pk',$this->class_pk,true);
		$criteria->compare('class_ref_room_pk',$this->class_ref_room_pk,true);
		$criteria->compare('class_ref_room_no',$this->class_ref_room_no,true);
		$criteria->compare('class_start_date',$this->class_start_date,true);
		$criteria->compare('class_end_date',$this->class_end_date,true);
		$criteria->compare('class_start_time',$this->class_start_time,true);
		$criteria->compare('class_end_time',$this->class_end_time,true);
		$criteria->compare('class_status',$this->class_status,true);
		$criteria->compare('class_days_on_week',$this->class_days_on_week,true);
		$criteria->compare('class_ref_batch_pk',$this->class_ref_batch_pk,false);
		$criteria->compare('class_ref_batch_id',$this->class_ref_batch_id,true);
		$criteria->compare('class_ref_subject_pk',$this->class_ref_subject_pk,true);
		$criteria->compare('class_ref_subject_name',$this->class_ref_subject_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeValidate()
	{
		if(!$this->ignoreClash)
		{
			//Setup criteria to detect clash
			$calendar = new Calendar('search');
			$calendar->calendar_ref_room_no = $this->class_ref_room_no;
			$calendar->calendar_day = $this->class_days_on_week;
			$calendar->calendar_reference = "<>'class#$this->class_pk'";
			$calendar->calendar_start_time = $this->class_start_time;
			$calendar->calendar_end_time = $this->class_end_time;

			if(!$calendar->isAvailable($this->class_start_date, $this->class_end_date))
			{
				$this->addError('class_ref_room_no', 'This schedule will make a clash with existing schedule');
			}
		}
		return parent::beforeValidate();
	}
}