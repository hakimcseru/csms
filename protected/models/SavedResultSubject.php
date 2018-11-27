<?php

/**
 * This is the model class for table "saved_result_subject".
 *
 * The followings are the available columns in table 'saved_result_subject':
 * @property integer $id
 * @property integer $saved_result_id
 * @property integer $subject_id
 * @property string $subject_code
 * @property string $subject_name
 * @property string $subject_full_mark
 * @property string $student_subject_marks
 */
class SavedResultSubject extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SavedResultSubject the static model class
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
		return 'saved_result_subject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('saved_result_id, subject_id, subject_code, subject_name', 'required'),
			array('saved_result_id, subject_id, subject_min_mark', 'numerical', 'integerOnly'=>true),
			array('subject_code', 'length', 'max'=>50),
			array('subject_name, subject_full_mark', 'length', 'max'=>250),
			array('student_subject_marks', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, saved_result_id, subject_id, subject_code, subject_min_mark, subject_name, subject_full_mark, student_subject_marks', 'safe', 'on'=>'search'),
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
			'saved_result_id' => 'Saved Result',
			'subject_id' => 'Subject',
			'subject_code' => 'Subject Code',
			'subject_name' => 'Subject Name',
			'subject_full_mark' => 'Subject Full Mark',
			'student_subject_marks' => 'Student Subject Marks',
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
		$criteria->compare('saved_result_id',$this->saved_result_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('subject_code',$this->subject_code,true);
		$criteria->compare('subject_name',$this->subject_name,true);
		$criteria->compare('subject_full_mark',$this->subject_full_mark,true);
		$criteria->compare('student_subject_marks',$this->student_subject_marks,true);
		$criteria->compare('subject_min_mark',$this->subject_min_mark);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}