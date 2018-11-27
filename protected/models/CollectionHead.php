<?php

/**
 * This is the model class for table "collection_head".
 *
 * The followings are the available columns in table 'collection_head':
 * @property string $id
 * @property string $head_title
 * @property string $head_code
 * @property integer $session
 * @property integer $course
 * @property string $student_type
 * @property integer $apply_on_month
 * @property double $collection_amount
 * @property string $purpose
 * @property string $active
 */
class CollectionHead extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CollectionHead the static model class
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
		return 'collection_head';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' session, course,head_group_id, student_type, apply_on_month, collection_amount', 'required'),
			array('session, course, apply_on_month', 'numerical', 'integerOnly'=>true),
			array('collection_amount', 'numerical'),
			
			
			array('student_type, active', 'length', 'max'=>13),
			array('purpose', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,  head_code, session,head_group_id, course, student_type, apply_on_month, collection_amount, purpose, active', 'safe', 'on'=>'search'),
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
                    'head_group' => array(self::BELONGS_TO, 'StudentCollectionGroup', 'head_group_id'),
					'coursee' => array(self::BELONGS_TO, 'Course', 'course'),
					
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core','ID'),
			'head_group_id' => Yii::t('core','Head Group'),
			
			'session' => Yii::t('core','Session'),
			'course' => Yii::t('core','Course'),
			'student_type' => Yii::t('core','Student Type'),
			'apply_on_month' => Yii::t('core','Apply On Month'),
			'collection_amount' => Yii::t('core','Collection Amount'),
			'purpose' => Yii::t('core','Purpose'),
			'active' => Yii::t('core','Active'),
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

		$criteria->compare('id',$this->id,false);
		$criteria->compare('head_group_id',$this->head_group_id,true);
		
		$criteria->compare('session',$this->session,false);
		$criteria->compare('course',$this->course,false);
		$criteria->compare('student_type',$this->student_type,false);
		$criteria->compare('apply_on_month',$this->apply_on_month,false);
		$criteria->compare('collection_amount',$this->collection_amount,false);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>100)
		));
	}
}