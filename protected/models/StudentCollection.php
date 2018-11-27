<?php
/**
 * This is the model class for table "student_collection".
 *
 * The followings are the available columns in table 'student_collection':
 * @property string $id
 * @property string $student_pk
 * @property string $student_id
 * @property string $collection_id
 * @property double $collection_amount
 * @property string $comment
 * @property string $collection_date
 * @property string $collection_type
 * @property integer $bank_id
 * @property string $deposite_date
 * @property string $session_id
 * @property string $course_id
 */
class StudentCollection extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentCollection the static model class
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
		return 'student_collection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_pk, student_id, collection_id, collection_amount, collection_date, session_id, course_id', 'required'),
			array(' collection_detail_id','numerical', 'integerOnly'=>true),
			array('collection_amount', 'numerical'),
			array('student_pk, collection_id, session_id, course_id, bank_id', 'length', 'max'=>20),
			array('student_id', 'length', 'max'=>16),
			array('collection_type', 'length', 'max'=>6),
                        array('year', 'length', 'max'=>11),
			array('month', 'length', 'max'=>250),
			array('comment, deposite_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_pk, collection_detail_id, student_id, collection_id, collection_amount, comment, collection_date, collection_type, bank_id, deposite_date, session_id, course_id, year, month', 'safe', 'on'=>'search'),
		);
	}

        //getCollectionHeadWise($start_date=$model->start_date,$end_date=$model->end_date);
		
		public function getCollectionHeadWise($start_date,$end_date,$session) 
			{
				if(isset($start_date) && isset($end_date))
				{
					$connection=Yii::app()->db;
					if($session)
					$command=$connection->createCommand("select comment,bank_id,sum(collection_amount) as ca from student_collection where deposite_date >= '".$start_date."' and deposite_date <= '".$end_date."' and session_id='".$session."' and session_id IS NOT NULL and bank_id IS NOT NULL group by comment ");
					else
					$command=$connection->createCommand("select comment,bank_id,sum(collection_amount) as ca from student_collection where deposite_date >= '".$start_date."' and deposite_date <= '".$end_date."' and session_id IS NOT NULL and bank_id IS NOT NULL group by comment ");
					
					$result=$command->queryAll();
					return $result;
				}
				else 
					return 0;
			}
	
        public function getTotals($column,$student_pk,$session_id=0)
			{
                 $connection=Yii::app()->db;
				 if($session_id)
                 $command=$connection->createCommand("SELECT SUM($column) FROM student_collection where student_pk=".$student_pk." and session_id='".$session_id."'");
				 else
				 $command=$connection->createCommand("SELECT SUM($column) FROM student_collection where student_pk=".$student_pk);
                 return '<span style="color:red;">'.Bndate::t($command->queryScalar()).'</span>';
 				//return '100';
			}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		//'collection_head' => array(self::BELONGS_TO, 'Department', 'department_id'),
		'bankinfo' => array(self::BELONGS_TO, 'BankInfo', 'bank_id'),
		'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
		'students' => array(self::BELONGS_TO, 'Student', 'student_pk'),
		);
	}
	
	public function getTotalCollectionHeadWise($comment,$session_id,$bank_id,$start_date,$end_date)
	{
	
	if($session_id && isset($comment) && isset($bank_id))
		{
		
			$connection=Yii::app()->db;
			$command=$connection->createCommand("select sum(collection_amount) as ca from student_collection where comment = '".$comment."' and session_id = '".$session_id."' and  bank_id= '".$bank_id."' and (deposite_date>='".$start_date."' and deposite_date<='".$end_date."')");
			$result=$command->queryScalar();
			return $result;
		}
		elseif(isset($comment) && isset($bank_id))
		{
			$connection=Yii::app()->db;
			$command=$connection->createCommand("select sum(collection_amount) as ca from student_collection where comment = '".$comment."' and bank_id= '".$bank_id."' and (deposite_date>='".$start_date."' and deposite_date<='".$end_date."')");
			$result=$command->queryScalar();
			return $result;
		}
		else 
			return 0;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core','ID'),
			'student_pk' => Yii::t('core','Student Pk'),
			'student_id' => Yii::t('core','Student'),
			'collection_id' => Yii::t('core','Collection'),
			'collection_amount' => Yii::t('core','Collection Amount'),
			'comment' => Yii::t('core','Comment'),
			'collection_date' => Yii::t('core','Collection Date'),
			'collection_type' => Yii::t('core','Collection Type'),
			'bank_id' => Yii::t('core','Bank'),
			'deposite_date' => Yii::t('core','Deposit Date'),
			'session_id' => Yii::t('core','Session'),
			'course_id' => Yii::t('core','Course'),
                        'year' => Yii::t('core','Year'),
			'month' => Yii::t('core','Month'),
		);
	}
	
	public function getTotalss($column,$ids)	
        {
		if($ids){
			$ids = implode(",",$ids);
			
					
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT SUM($column) FROM student_collection where id in ('$ids')");
			return $amount = $command->queryScalar();
		}
		else 
          return '0';
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
		$criteria->compare('collection_detail_id',$this->collection_detail_id,true);
		
		$criteria->compare('student_pk',$this->student_pk,false);
		$criteria->compare('student_id',$this->student_id,false);
		$criteria->compare('collection_id',$this->collection_id,true);
		$criteria->compare('collection_amount',$this->collection_amount);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('collection_date',$this->collection_date,true);
		$criteria->compare('collection_type',$this->collection_type,true);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('deposite_date',$this->deposite_date,true);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('course_id',$this->course_id,true);
                $criteria->compare('year',$this->year,true);
		$criteria->compare('month',$this->month,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>100)
		));
	}
}