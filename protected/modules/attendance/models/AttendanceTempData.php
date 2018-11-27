<?php

/**
 * This is the model class for table "attendance_temp_data".
 *
 * The followings are the available columns in table 'attendance_temp_data':
 * @property string $id
 * @property string $core_employee_id
 * @property string $date
 * @property string $time
 * @property string $mode
 * @property string $note
 *
 * The followings are the available model relations:
 * @property CoreEmployee $employee
 */
class AttendanceTempData extends CActiveRecord {

	public $dateFrom, $dateTo;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttendanceTempData the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'attendance_temp_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('core_employee_id, date, time, mode', 'required'),
			array('note', 'default', 'setOnEmpty' => true, 'value' => null),
			array('core_employee_id', 'length', 'max' => 20),
			array('mode', 'length', 'max' => 4),
			array('note', 'length', 'max' => 256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, core_employee_id, date, time, mode, note, dateFrom, dateTo', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'employee' => array(self::BELONGS_TO, 'CoreEmployee', 'core_employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('attendance',  'ID'),
			'core_employee_id' => Yii::t('attendance',  'Employee'),
			'date' =>Yii::t('attendance',  'Date'),
			'time' => Yii::t('attendance', 'Time'),
			'mode' => Yii::t('attendance', 'Mode'),
			'note' => Yii::t('attendance', 'Note'),
			'dateFrom'=>Yii::t('attendance', 'Date From'),
			'dateTo'=>Yii::t('attendance', 'Date To'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('t.core_employee_id', $this->core_employee_id, false);
		if(isset($this->dateFrom,  $this->dateTo))
			$criteria->addBetweenCondition('t.date', $this->dateFrom, $this->dateTo);
		$criteria->order = 't.date DESC, t.core_employee_id ASC, t.time ASC';

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState(get_class($this).'_pageSize'),
			),
			'criteria' => $criteria,
		));
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

	public function tMode(){
		if($this->mode == 'IN')
			return Yii::t('attendance','In');
		if($this->mode == 'OUT')
			return Yii::t('attendance','Out');
		return $this->mode;
	}

	public function tCore_employee_id(){
		if(Yii::app()->language == 'bn')
			return Bndate::bangla_number($this->core_employee_id);
		return $this->core_employee_id;
	}

	public function tDate(){
		if(Yii::app()->language == 'bn')
		{
			$bndate = new Bndate(strtotime($this->date));
			$date = $bndate->get_date();
			return $date[0].' '.$date[1].' '.$date[2];
		}
		return $this->date;
	}

	public function tTime(){
		if(Yii::app()->language == 'bn')
		{
			/*$bndate = new Bndate(strtotime($this->time));
			$date = $bndate->get_date();
			$time = $bndate->bangla_number(date('H:i:s', strtotime($this->time)));
			return $date[0].' '.$date[1].' '.$date[2].', '.$time;*/
			return Bndate::bangla_number(date('H:i', strtotime($this->time)));
		}
		return $this->time;
	}

	public static function modeList(){
		return array(
			'IN'=>Yii::t('attendance','In'),
			'OUT'=>Yii::t('attendance','Out'),
			);
	}

	public function save($runValidation = true, $attributes = null) {
		if($this->model()->exists("core_employee_id = $this->core_employee_id AND date = '$this->date' AND time = '$this->time' AND mode='$this->mode'"))
			return true;
		return parent::save($runValidation, $attributes);
	}
/*
	public function processData()
	{
		if($this->isNewRecord) return;

		if(empty($this->employee)){
			$this->note = "Error: Invalid Employee.";
			parent::save(false);
			return;
		}
		if(empty ($this->employee->shift)){
			$this->note = "Error: No Shift Define.";
			parent::save(false);
			return;
		}

		$day = date('l',  strtotime($this->date));
		$workDay = true;

		//check for workday
		if(empty($this->employee->shift->$day))
		{
			//Day Off
			$this->note = "Note: Day off";
			$workDay = false;
		}

		//workday
		//If time is smaller than cut-off time of shift, attendance will be count for previous day.
		if($workDay && $this->time < $this->employee->shift->$day->cut_out_time)
		{
			$this->date = date('Y-m-d', strtotime($this->date) - 24*60*60);
			$day = date('l',  strtotime($this->date));
			$this->note = "Info: Attendance Shifted to Previous date.";
			if(empty($this->employee->shift->$day))
			{
				//Day Off
				$this->note = "Note: Day off";
				$workDay = false;
			}
		}
		//Check if employee is on leave
		if(AttendanceLeave::model()->exists("core_employee_id = $this->core_employee_id AND '$this->date' >= start_date AND '$this->date' <= end_date"))
		{
			$this->note = "Error: Employee is on Leave.";
			parent::save(false);
			return;
		}
		//Get attendance previously inserted for this date.
		$finalData = AttendanceFinalData::model()->find("core_employee_id=$this->core_employee_id AND date='$this->date'");
		if(empty($finalData))
			$finalData = new AttendanceFinalData ();
		$logs = json_decode($finalData->json_log,true);
		if(!is_array($logs))
		{
			//Previous data not available
			$logs = array();
		}
		if($this->mode == 'IN')
			$logs[] = array('mode'=>'IN', 'time'=>$this->time);
		else
			$logs[] = array('mode'=>'OUT', 'time'=>$this->time);
		//Calculate in, out and break time
		$in_time = strtotime($finalData->in_time);
		$out_time = strtotime($finalData->out_time);
		$break_start = strtotime($finalData->break_start);
		$break_end = strtotime($finalData->break_end);
		foreach($logs as $log)
		{
			$time = strtotime($log['time']);
			if($log['mode'] === 'IN')
			{
				//If time is less than current in time, It is will be count as in.
				if(!$in_time  || $time < $in_time){
					//swich current in time to break end time
					if(!$break_end  || $in_time > $break_end){
						$finalData->break_end = $finalData->in_time;
					}
					$finalData->in_time = $log['time'];
					$in_time = $time;
				}
				//If time is less than current break_end time, It is will be count as break_end.
				elseif(!$break_end  || $time > $break_end){
					$finalData->break_end = $log['time'];
				}
			}
			elseif($log['mode'] === 'OUT')
			{
				//If time is grater than current out time, It will be count as out
				if(!$out_time  || $time > $out_time){
					//switch current out_time to break_start time
					if(!$break_start  || $out_time < $break_start){
						$finalData->break_start = $finalData->out_time;
					}
					$finalData->out_time = $log['time'];
					$out_time = $time;
				}
				//If time is grater than current break_start time, It will be count as break_start
				elseif(!$break_start  || $time < $break_start){
					$finalData->break_start = $log['time'];
				}
			}
		}

		//Remove Duplicate Data
		if($finalData->in_time == $finalData->break_end) $finalData->break_end = null;
		if($finalData->out_time == $finalData->break_start) $finalData->break_start = null;

		//Calculate Late In, Early Out
		$finalData->status = $workDay? 'P ' : 'X P ';
		
		if($workDay && !$this->employee->shift->ignoreLate){
			$shift_max_start_time = strtotime($this->date.' '.$this->employee->shift->$day->max_start_time);
			$shift_min_end_time = strtotime($this->date.' '.$this->employee->shift->$day->min_end_time);
			if(empty($finalData->in_time) || $in_time > $shift_max_start_time) $finalData->status .= 'L ';
			if(empty($finalData->out_time) || $out_time < $shift_min_end_time) $finalData->status .= 'E '; //for removing the E from database
		}

		//Calculate Workhour
		$inCount = $outCount = $inSum = $outSum = 0;
		foreach($logs as $log){
			if($log['mode']=='IN')
			{
				$inSum += strtotime($log['time']);
				++$inCount;
			}
			elseif($log['mode']=='OUT')
			{
				$outSum += strtotime($log['time']);
				++$outCount;
			}
		}
		if($inCount == $outCount && $inCount != 0 && $outSum > $inSum){
			$finalData->work_hour = round(($outSum - $inSum)/3600.0);
		}
		else
			$finalData->work_hour = 0;

		//Calculate Overtime
		if(!$workDay || ($this->employee->shift->ignoreOvertime || $finalData->work_hour == 0)){
			$finalData->over_time = 0;
		}
		else{
			$over_time = $finalData->work_hour - $this->employee->shift->$day->work_hour;
			$finalData->over_time = ($over_time > 0)? $over_time : 0;
		}

		//Save final data
		$finalData->core_employee_id = $this->employee->id;
		$finalData->core_employee_name = $this->employee->name;
		if($workDay){
			$finalData->core_shift_id = $this->employee->shift->$day->id;
			$finalData->core_shift_name = $this->employee->shift->$day->name;
		}
		$finalData->core_department_id = $this->employee->department->id;
		$finalData->core_department_name = $this->employee->department->name;
		$finalData->date = $this->date;
		$finalData->json_log = json_encode($logs);
		if($finalData->save(false))
			$this->delete ();
	}*/
	
	public function replaceStatus($str, $repby)
	{
		$str = str_replace($repby, "", $str, $count);
		
		return $str;
	}
	/*
	public function finalDataProcess($date)
	{
		

		$final_date=AttendanceFinalData::model()->findAll("date='".$date."'");
		
		foreach($final_date as $fdata):
		
		$emp_shift=EmpShiftCalendar::model()->find("emp_id='".$fdata->core_employee_id."' and date='".$fdata->date."'");
		

		if(isset($emp_shift))
		{
		
		$status="";
		
		//check for workday
		if($emp_shift->shift_id==17)
		{
			//Day Off
			$status.="O ";
			//$this->note = "Note: Day off";
			$workDay = false;
		}
		
		

		
		//Check if employee is on leave
		if(AttendanceLeave::model()->exists("core_employee_id = $fdata->core_employee_id AND '$fdata->date' >= start_date AND '$fdata->date' <= end_date"))
		{
			$status.="Lv ";
			//$this->note = "Error: Employee is on Leave.";
			//parent::save(false);
			return;
		}
		//Get attendance previously inserted for this date.
		$finalData = AttendanceFinalData::model()->find("core_employee_id=$fdata->core_employee_id AND date='$fdata->date'");
		if(empty($finalData))
			$finalData = new AttendanceFinalData ();
		$logs = json_decode($finalData->json_log,true);
		if(!is_array($logs))
		{
			//Previous data not available
			$logs = array();
		}
		
		// here i start
		if($emp_shift->shift->max_start_time > $emp_shift->shift->min_end_time)
		{
			$ndate = strtotime("+1 day", strtotime($fdata->date));
			$next_date= date('Y-m-d', $ndate);

			echo $schedule_start_time=$fdata->date." ".$emp_shift->shift->max_start_time;
			//$schedule_break_time=$fdata->date." ".$emp_shift->shift->break_time;
			//$schedule_resumen_time=$fdata->date." ".$emp_shift->shift->resume_time;
			echo $schedule_end_time=$fdata->date." ".$emp_shift->shift->min_end_time;
		}
		else
		{
			$schedule_start_time=$fdata->date." ".$emp_shift->shift->max_start_time;
			//$schedule_break_time=$fdata->date." ".$emp_shift->shift->break_time;
			//$schedule_resumen_time=$fdata->date." ".$emp_shift->shift->resume_time;
			$schedule_end_time=$fdata->date." ".$emp_shift->shift->min_end_time;
		
		}
		
		
			if(strtotime($fdata->in_time) <= strtotime($schedule_start_time))
			$status.=$this->replaceStatus($status,"P")." P";
			else $status.=$this->replaceStatus($status,"L")." L";
///

			if($emp_shift->shift->max_start_time > $emp_shift->shift->min_end_time)
			{
			$pdate = strtotime("-1 day", strtotime($fdata->date));
			$prev_date= date('Y-m-d', $pdate);
			}
			else
			{
				$prev_date= $fdata->date;
			}
		
			if(strtotime($fdata->out_time) <= strtotime($prev_date." ".$emp_shift->shift->min_end_time))
			$status.=$fdata->replaceStatus($status,"E")."E ";
			else $status.=$fdata->status;
								

			
			$fdata->status=$status;
			$fdata->save();
								
						
			
		
	endforeach;	
		//echo $fdata->employee->name;
	 //die();
	}
	
	}*/
	
	public function processData()
	{
		if($this->isNewRecord) return;

		if(empty($this->employee)){
			$this->note = "Error: Invalid Employee.";
			parent::save(false);
			return;
		}
		if(empty ($this->employee->shift)){
			$this->note = "Error: No Shift Define.";
			parent::save(false);
			return;
		}

		$day = date('l',  strtotime($this->date));
		$workDay = true;

		
		$emp_shift=EmpShiftCalendar::model()->find("emp_id='".$this->core_employee_id."' and date='".$this->date."'");
		//echo $emp_shift->shift_id; die();
		
		
		
		if(isset($emp_shift))
		{
		
		$status="";
		
		//check for workday
		if($emp_shift->shift_id==17)
		{
			//Day Off
			$status.="O ";
			$this->note = "Note: Day off";
			$workDay = false;
		}
		
		

		//workday
		//If time is smaller than cut-off time of shift, attendance will be count for previous day.
		/*
		if($workDay && $this->time < $this->employee->shift->$day->cut_out_time)
		{
			$this->date = date('Y-m-d', strtotime($this->date) - 24*60*60);
			$day = date('l',  strtotime($this->date));
			$this->note = "Info: Attendance Shifted to Previous date.";
			if(empty($this->employee->shift->$day))
			{
				//Day Off
				$this->note = "Note: Day off";
				$workDay = false;
			}
		}*/
		
		//echo "core_employee_id = $this->core_employee_id AND '$this->date' >= start_date AND '$this->date' <= end_date";
		//Check if employee is on leave
		/*if(AttendanceLeave::model()->exists("core_employee_id = $this->core_employee_id AND '$this->date' >= start_date AND '$this->date' <= end_date"))
		{
			$status.=" Lv";
			$this->note = "Error: Employee is on Leave.";
			//parent::save(false);
			return;
		}*/
		//Get attendance previously inserted for this date.
		$finalData = AttendanceFinalData::model()->find("core_employee_id=$this->core_employee_id AND date='$this->date'");
		//echo "emp_id='".$this->core_employee_id."' and date='".$this->date."'"; die();
		if(empty($finalData))
			$finalData = new AttendanceFinalData ();
		$logs = json_decode($finalData->json_log,true);
		if(!is_array($logs))
		{
			//Previous data not available
			$logs = array();
		}
		
		// here i start
		if($emp_shift->shift->max_start_time > $emp_shift->shift->min_end_time)
		{
			$ndate = strtotime("+1 day", strtotime($this->date));
			$next_date= date('Y-m-d', $ndate);

			echo $schedule_start_time=$this->date." ".$emp_shift->shift->max_start_time;
			//$schedule_break_time=$this->date." ".$emp_shift->shift->break_time;
			//$schedule_resumen_time=$this->date." ".$emp_shift->shift->resume_time;
			echo $schedule_end_time=$this->date." ".$emp_shift->shift->min_end_time;
		}
		else
		{
			$schedule_start_time=$this->date." ".$emp_shift->shift->max_start_time;
			//$schedule_break_time=$this->date." ".$emp_shift->shift->break_time;
			//$schedule_resumen_time=$this->date." ".$emp_shift->shift->resume_time;
			$schedule_end_time=$this->date." ".$emp_shift->shift->min_end_time;
		
		}
		
		//echo $this->time." ";
		
		echo $schedule_start_time." ";
		echo $schedule_end_time." "; 
		echo $this->time; //die();
		
		//die();
		// end here
		
		
		
		$to_time = strtotime($this->time);
		$from_time = strtotime($schedule_start_time);
		$start_diff= abs($to_time - $from_time);
		
		$from_time = strtotime($schedule_end_time);
		$end_diff= abs($to_time - $from_time);
		
		echo $start_diff." ".$end_diff;
	
		
		if((int)$start_diff <= (int)$end_diff)
		{
		
		//echo "Asi"; die();
			if(strtotime($this->time) <= strtotime($schedule_start_time))
								$status.=$this->replaceStatus($status,"P")." P";
								else $status.=$this->replaceStatus($status,"L")." L";
								
			if(isset($finalData))
				{
					
								
					if(isset($finalData->in_time))
						{
							if(strtotime($this->time) < strtotime($finalData->in_time))
							{
								
								// change the value
								$finalData->in_time=$this->time;
								echo $finalData->core_employee_id = $this->employee->id;
								echo $finalData->core_employee_name = $this->employee->name;
								$finalData->core_shift_id = $emp_shift->shift_id;
								$finalData->core_shift_name = $emp_shift->shift->name;
								$finalData->core_department_id = $this->employee->department->id;
								$finalData->core_department_name = $this->employee->department->name;
								echo $finalData->date = $this->date;
								$finalData->json_log = json_encode($logs);
								$finalData->status=$status;
								if($finalData->save()) $this->delete();
								
							}
							else
							{
								// not change
								
								
								if($this->delete()) echo "paisi0000";
							}
						}
					else 
						{
							// new entry
							
							$finalData->in_time=$this->time;
							echo $finalData->core_employee_id = $this->employee->id;
							echo $finalData->core_employee_name = $this->employee->name;
							$finalData->core_shift_id = $emp_shift->shift_id;
							$finalData->core_shift_name = $emp_shift->shift->name;
							$finalData->core_department_id = $this->employee->department->id;
							$finalData->core_department_name = $this->employee->department->name;
							echo $finalData->date = $this->date;
							$finalData->json_log = json_encode($logs);
							$finalData->status=$status;
							if($finalData->save())
							$this->delete();
							
						}
				}
			else
				{
					
					// new entry 
					$finalData->in_time=$this->time;
					$finalData->core_employee_id = $this->employee->id;
					$finalData->core_employee_name = $this->employee->name;
					$finalData->core_shift_id = $emp_shift->shift_id;
					$finalData->core_shift_name = $emp_shift->shift->name;
					$finalData->core_department_id = $this->employee->department->id;
					$finalData->core_department_name = $this->employee->department->name;
					$finalData->date = $this->date;
					$finalData->status=$status;
					$finalData->json_log = json_encode($logs);
					if($finalData->save())
					$this->delete();
				}
		}
	else
		{
		
		echo "labla";
		//echo $this->date;
		if($emp_shift->shift->max_start_time > $emp_shift->shift->min_end_time)
		{
		$pdate = strtotime("-1 day", strtotime($this->date));
		$prev_date= date('Y-m-d', $pdate);
		}
		else
		{
		
		$prev_date= $this->date;
		
		}
		
		
		$finalData2 = AttendanceFinalData::model()->find("core_employee_id=$this->core_employee_id AND date='$prev_date'");
				
		
			if(isset($finalData2))
				{
				//echo $emp_shift->shift_id; die();
				if(strtotime($this->time) <= strtotime($prev_date." ".$emp_shift->shift->min_end_time))
								$status.=$this->replaceStatus($status.$finalData2->status,"E")." E ";
								else $status.=$finalData2->status;
				//echo "core_employee_id=$this->core_employee_id AND date='$prev_date'"; die();
				
					if(isset($finalData2->out_time))
						{
						
						//echo $this->time; echo "fsdf";
						//echo "ee".$finalData2->out_time."ee";
							if(strtotime($this->time) > strtotime($finalData2->out_time))
							{
							//echo $this->time; echo "fsdf";
								// change the value
								echo $this->time;
								$finalData2->out_time=$this->time;
								$finalData2->core_employee_id = $this->employee->id;
								$finalData2->core_employee_name = $this->employee->name;
								$finalData2->core_shift_id = $emp_shift->shift_id;
								$finalData2->core_shift_name = $emp_shift->shift->name;
								$finalData2->core_department_id = $this->employee->department->id;
								$finalData2->core_department_name = $this->employee->department->name;
								$finalData2->date = $prev_date;
								$finalData2->status=$status;
								$finalData2->json_log = json_encode($logs);
								if($finalData2->save()) $this->delete();
							}
							else
							{
							//echo $this->time; echo "out";
								// not change
								$this->delete();
							}
						}
					else 
						{
						
							// new entry
							// change the value
							//echo $this->time; echo "fsdf";
								$finalData2->out_time=$this->time;
								$finalData2->core_employee_id = $this->employee->id;
								$finalData2->core_employee_name = $this->employee->name;
								$finalData2->core_shift_id = $emp_shift->shift_id;
								$finalData2->core_shift_name = $emp_shift->shift->name;
								$finalData2->core_department_id = $this->employee->department->id;
								$finalData2->core_department_name = $this->employee->department->name;
								$finalData2->date = $prev_date;
								$finalData2->status=$status;
								$finalData2->json_log = json_encode($logs);
								if($finalData2->save()) $this->delete();
								
						}
				}
			else
				{
				//echo "got it"; die();
				if(strtotime($this->time) <= strtotime($prev_date." ".$emp_shift->shift->min_end_time))
								$status=$this->replaceStatus($status,"E")." E";
								else $status=$this->replaceStatus($status,"P")." P";
								
					$finalData2 = new AttendanceFinalData;
					// new entry 
					$finalData2->out_time=$this->time;
					$finalData2->core_employee_id = $this->employee->id;
					$finalData2->core_employee_name = $this->employee->name;
					$finalData2->core_shift_id = $emp_shift->shift_id;
					$finalData2->core_shift_name = $emp_shift->shift->name;
					$finalData2->core_department_id = $this->employee->department->id;
					$finalData2->core_department_name = $this->employee->department->name;
					$finalData2->date = $prev_date;
					$finalData2->status=$status;
					$finalData2->json_log = json_encode($logs);
					if($finalData2->save()) $this->delete(); 
				} 
		}
		
		////////////////////////////////////////////////
		/*
		if($this->mode == 'IN')
			$logs[] = array('mode'=>'IN', 'time'=>$this->time);
		else
			$logs[] = array('mode'=>'OUT', 'time'=>$this->time);
		//Calculate in, out and break time
		$in_time = strtotime($finalData->in_time);
		$out_time = strtotime($finalData->out_time);
		$break_start = strtotime($finalData->break_start);
		$break_end = strtotime($finalData->break_end);
		foreach($logs as $log)
		{
			$time = strtotime($log['time']);
			
			
			
			if($log['mode'] === 'IN')
			{
				//If time is less than current in time, It is will be count as in.
				if(!$in_time  || $time < $in_time){
					//swich current in time to break end time
					if(!$break_end  || $in_time > $break_end){
						$finalData->break_end = $finalData->in_time;
					}
					$finalData->in_time = $log['time'];
					$in_time = $time;
				}
				//If time is less than current break_end time, It is will be count as break_end.
				elseif(!$break_end  || $time > $break_end){
					$finalData->break_end = $log['time'];
				}
			}
			elseif($log['mode'] === 'OUT')
			{
				//If time is grater than current out time, It will be count as out
				if(!$out_time  || $time > $out_time){
					//switch current out_time to break_start time
					if(!$break_start  || $out_time < $break_start){
						$finalData->break_start = $finalData->out_time;
					}
					$finalData->out_time = $log['time'];
					$out_time = $time;
				}
				//If time is grater than current break_start time, It will be count as break_start
				elseif(!$break_start  || $time < $break_start){
					$finalData->break_start = $log['time'];
				}
			}
		}

		//Remove Duplicate Data
		if($finalData->in_time == $finalData->break_end) $finalData->break_end = null;
		if($finalData->out_time == $finalData->break_start) $finalData->break_start = null;

		//Calculate Late In, Early Out
		$finalData->status = $workDay? 'P ' : 'X P ';
		
		if($workDay && !$this->employee->shift->ignoreLate){
			$shift_max_start_time = strtotime($this->date.' '.$this->employee->shift->$day->max_start_time);
			$shift_min_end_time = strtotime($this->date.' '.$this->employee->shift->$day->min_end_time);
			if(empty($finalData->in_time) || $in_time > $shift_max_start_time) $finalData->status .= 'L ';
			if(empty($finalData->out_time) || $out_time < $shift_min_end_time) $finalData->status .= 'E '; //for removing the E from database
		}

		//Calculate Workhour
		$inCount = $outCount = $inSum = $outSum = 0;
		foreach($logs as $log){
			if($log['mode']=='IN')
			{
				$inSum += strtotime($log['time']);
				++$inCount;
			}
			elseif($log['mode']=='OUT')
			{
				$outSum += strtotime($log['time']);
				++$outCount;
			}
		}
		if($inCount == $outCount && $inCount != 0 && $outSum > $inSum){
			$finalData->work_hour = round(($outSum - $inSum)/3600.0);
		}
		else
			$finalData->work_hour = 0;

		//Calculate Overtime
		if(!$workDay || ($this->employee->shift->ignoreOvertime || $finalData->work_hour == 0)){
			$finalData->over_time = 0;
		}
		else{
			$over_time = $finalData->work_hour - $this->employee->shift->$day->work_hour;
			$finalData->over_time = ($over_time > 0)? $over_time : 0;
		}

		//Save final data
		$finalData->core_employee_id = $this->employee->id;
		$finalData->core_employee_name = $this->employee->name;
		if($workDay){
			$finalData->core_shift_id = $this->employee->shift->$day->id;
			$finalData->core_shift_name = $this->employee->shift->$day->name;
		}
		$finalData->core_department_id = $this->employee->department->id;
		$finalData->core_department_name = $this->employee->department->name;
		$finalData->date = $this->date;
		$finalData->json_log = json_encode($logs);
		//if($finalData->save(false))
		//	$this->delete ();*/
	}
	else
		{
			//$this->delete();
		}
		echo $this->employee->name;
	 //die();
	}

}