<?php

class AttendanceReport
{
	public function departmentOT()
	{
		$command = Yii::app()->db->createCommand();
		$command->select(array('core_department_name as department','sum(attendance_final_data_over_time) as OT'));
		$command->from(array(Yii::app()->db->tablePrefix.'attendance_final_data',Yii::app()->db->tablePrefix.'core_department'));
		$command->where("core_department_id = attendance_final_data_ref_core_department_id AND
			attendance_final_data_date BETWEEN CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )");
		$command->group('attendance_final_data_ref_core_department_id');

		return $command->queryAll();
	}

	public function MonthlyDepartmentAttendance($startDay="", $endDay="")
	{

		$command = Yii::app()->db->createCommand();
		$command->select(array('core_department_name as department',
			'sum( if( `attendance_final_data_status` LIKE "%P %", 1, 0 ) ) AS regular',
			'sum( if( `attendance_final_data_status` LIKE "%A %", 1, 0 ) ) AS absent',
			'sum( if( `attendance_final_data_status` LIKE "%IL %", 1, 0 ) ) AS late_in',
			'sum( if( `attendance_final_data_status` LIKE "%OE %", 1, 0 ) ) AS early_out',
			'sum( if( `attendance_final_data_status` LIKE "%L.. %", 1, 0 ) ) AS on_leave'));
		$command->from(array(Yii::app()->db->tablePrefix.'attendance_final_data',Yii::app()->db->tablePrefix.'core_department'));
		if($startDay != "")
		{
			if($endDay == "")
			{
				$endDay = $startDay;
			}
			$command->where("core_department_id = attendance_final_data_ref_core_department_id AND
			attendance_final_data_date BETWEEN '$startDay' AND '$endDay'");
		}
		else
		{
			$command->where("core_department_id = attendance_final_data_ref_core_department_id AND
			attendance_final_data_date BETWEEN CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )");
		}
		$command->group('attendance_final_data_ref_core_department_id');

		return $command->queryAll();
	}

	public function lastDayAttendanceSummery($startDay="", $endDay="")
	{
		$command = Yii::app()->db->createCommand();
		$command->select(array(
			'sum( if( `attendance_final_data_status` LIKE "%P %", 1, 0 ) ) AS regular',
			'sum( if( `attendance_final_data_status` LIKE "%A %", 1, 0 ) ) AS absent',
			'sum( if( `attendance_final_data_status` LIKE "%IL %", 1, 0 ) ) AS late_in',
			'sum( if( `attendance_final_data_status` LIKE "%OE %", 1, 0 ) ) AS early_out',
			'sum( if( `attendance_final_data_status` LIKE "%L.. %", 1, 0 ) ) AS on_leave'));
		$command->from(array(Yii::app()->db->tablePrefix.'attendance_final_data'));
		if($startDay !== "")
		{
			if($endDay == "")
			{
				$endDay = $startDay;
			}
			$command->where("attendance_final_data_date BETWEEN '$startDay' AND '$endDay'");
		}
		else
		{
			$command->where("attendance_final_data_date = (select max(attendance_final_data_date))");
		}
		return $command->queryRow();
	}

	public function sendSmsReport($date="")
	{
		if (isset(Yii::app()->modules['sms']))
		{
			Yii::app()->getModule('sms');

			if($date == "")
			{
				$date = date('Y-m-d');
			}
			$reports = $this->MonthlyDepartmentAttendance($date);

			foreach($reports as $report)
			{
				$department = CoreDepartment::model()->findByAttributes(array('core_department_name'=>$report['department']));
				if(isset ($department->core_department_contact))
				{
					$contacts = split(',', $department->core_department_contact);
					foreach ($contacts as $contact)
					{
						if(strlen($contact) < 11) continue;
						$sms = new SmsOutbox();
						$sms->DestinationNumber = $contact;
						$sms->TextDecoded = "Attendance Report\n";
						$sms->TextDecoded .= "Dept: ".$report['department']."\n";
						$sms->TextDecoded .= "Date: ".$date."\n";
						$sms->TextDecoded .= "Regular: ".$report['regular']."\n";
						$sms->TextDecoded .= "Absent: ".$report['absent']."\n";
						$sms->TextDecoded .= "On Leave: ".$report['on_leave']."\n";
						$sms->TextDecoded .= "Late In: ".$report['late_in']."\n";
						$sms->TextDecoded .= "Early Out: ".$report['early_out']."\n";
						$sms->save(false);
					}
				}
			}
			return true;
		}
		return false;
	}
}
?>