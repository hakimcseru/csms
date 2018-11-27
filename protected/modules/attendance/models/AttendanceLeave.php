<?php

/**
 * This is the model class for table "attendance_leave".
 *
 * The followings are the available columns in table 'attendance_leave':
 * @property string $id
 * @property string $core_employee_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $duration
 * @property string $type
 * @property string $description
 * @property string $responsible_person_id
 * @property string $approved_by_id
 * @property string $note
 *
 * The followings are the available model relations:
 * @property CoreEmployee $approvedBy
 * @property CoreEmployee $coreEmployee
 * @property CoreEmployee $responsiblePerson
 */
class AttendanceLeave extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttendanceLeave the static model class
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
		return 'attendance_leave';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('core_employee_id, start_date, end_date, type', 'required'),
			array('core_employee_id, responsible_person_id, approved_by_id', 'exist', 'className'=>'CoreEmployee', 'attributeName'=>'id'),
			array('responsible_person_id, approved_by_id, description, note', 'default', 'value'=>null, 'setOnEmpty'=>true),
			array('core_employee_id, responsible_person_id, approved_by_id', 'numerical', 'integerOnly'=>true),
			array('duration', 'numerical', 'integerOnly'=>false),
			array('core_employee_id, responsible_person_id, approved_by_id', 'length', 'max'=>20),
			array('type', 'length', 'max'=>4),
			array('description, note', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, core_employee_id, start_date, end_date, duration, type, description, responsible_person_id, approved_by_id, note', 'safe', 'on'=>'search'),
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
			'approvedBy' => array(self::BELONGS_TO, 'CoreEmployee', 'approved_by_id'),
			'employee' => array(self::BELONGS_TO, 'CoreEmployee', 'core_employee_id'),
			'responsiblePerson' => array(self::BELONGS_TO, 'CoreEmployee', 'responsible_person_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attendance', 'ID'),
			'core_employee_id' => Yii::t('attendance','Employee'),
			'start_date' => Yii::t('attendance','Date From'),
			'end_date' => Yii::t('attendance','Date To'),
			'duration' => Yii::t('attendance','Duration'),
			'type' => Yii::t('attendance','Type'),
			'description' => Yii::t('attendance','Description'),
			'responsible_person_id' => Yii::t('attendance','Responsible Person'),
			'approved_by_id' => Yii::t('attendance','Approved By'),
			'note' => Yii::t('attendance','Note'),
			'image' => Yii::t('attendance','Image'),
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

		$criteria->compare('core_employee_id',$this->core_employee_id,false);
		$criteria->compare('start_date', '>='.$this->start_date,false);
		$criteria->compare('end_date', '<='.$this->end_date,false);
		$criteria->compare('type',$this->type,false);
		$criteria->with = array('employee');
		$criteria->order = 'start_date DESC, end_date ASC, core_employee_id ASC';

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState(get_class($this).'_pageSize'),
			),
			'criteria' => $criteria,
		));
	}

	public function beforeSave()
	{
		if(empty($this->duration))
			$this->duration = (strtotime($this->end_date) - strtotime($this->start_date))/(60*60*24) + 1;
		return parent::beforeSave();
	}

	public function beforeValidate()
	{
		if(strtotime($this->start_date) > strtotime($this->end_date))
		{
			$this->addError('end_date', Yii::t('attendance','End date cannot be smaller than start date'));
		}
		return parent::beforeValidate();
	}

	public function behaviors() {
		return array(
			'ERememberFiltersBehavior' => array(
				'class' => 'application.components.ERememberFiltersBehavior',
				'defaults' => array(), /* default value of attributes */
				'defaultStickOnClear' => false /* Put default value if user clear the attributes */
			),
		);
	}

	public static function getTypes(){
		return array(
			'LC'=> Yii::t('attendance', 'Casual Leave'),
			'LE'=> Yii::t('attendance', 'Earn leave'),
			'LM'=> Yii::t('attendance', 'Maternity leave'),
			'LO'=> Yii::t('attendance', 'Others leave'),
			'LS'=> Yii::t('attendance', 'Sick Leave'),
			'LW'=> Yii::t('attendance', 'Leave without pay'),
		);
	}
}