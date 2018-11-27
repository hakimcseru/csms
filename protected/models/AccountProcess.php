<?php

/**
 * This is the model class for table "account_process".
 *
 * The followings are the available columns in table 'account_process':
 * @property integer $id
 * @property integer $month
 * @property string $year
 * @property string $process_date
 * @property string $process_status
 * @property string $lock
 */
class AccountProcess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AccountProcess the static model class
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
		return 'account_process';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('month, year', 'required'),
			array('month', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>4),
			array('process_status', 'length', 'max'=>7),
			array('lock', 'length', 'max'=>3),
			array('process_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, month, year, process_date, process_status, lock', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'month' => 'Month',
			'year' => 'Year',
			'process_date' => 'Process Date',
			'process_status' => 'Process Status',
			'lock' => 'Lock',
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
		$criteria->compare('month',$this->month);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('process_date',$this->process_date,true);
		$criteria->compare('process_status',$this->process_status,true);
		$criteria->compare('lock',$this->lock,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}