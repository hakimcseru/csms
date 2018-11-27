<?php

class ReportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions' => array('index','employee','download','dashbord','daily','summary', 'entries', 'monthly','attendanceSummary','lateSummary'),
				'users' => array('admin'),
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
		//$this->layout = '//layouts/column1';
		//$this->render('index');
		$this->redirect('report/employee');
		//$model = new AttendanceReport();
		//$this->render('summery',array('model'=>$model->departmentOT()));
	}

    public function actionMonthly()
	{
		//$this->layout = '//layouts/column1';
		//$this->render('index');
		$this->render('monthly');
		//$model = new AttendanceReport();
		//$this->render('summery',array('model'=>$model->departmentOT()));
	}
        
	public function actionEmployeeOld()
	{
		$this->layout = '//layouts/print';

		$model= new AttendanceFinalData('report');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AttendanceFinalData']))
		{
			$model->attributes=$_GET['AttendanceFinalData'];
			if($model->validate())
			{
				$employee = CoreEmployee::model()->with('department','shift')->findByPk($model->attendance_final_data_ref_core_employee_id);
				$this->render('employee',array(
					'model'=>$model,
					'employee'=>$employee,
				));
				return;
			}
		}

		$this->render('employee',array(
			'model'=>$model,
		));
	}

	public function actionEmployee(){
		$model = new AttendanceFinalData();
		$model->unsetAttributes();
		if(isset($_POST['AttendanceFinalData'])){
			$model->setAttributes($_POST['AttendanceFinalData']);
		}
		$this->render('employee', array('model'=>$model));
	}

	public function actionLateSummary(){
		$model = new AttendanceFinalData();
		$model->unsetAttributes();
		if(isset($_POST['AttendanceFinalData'])){
			$model->setAttributes($_POST['AttendanceFinalData']);
		}
		$this->render('late_summary', array('model'=>$model));
		//$this->render('late_summary', array('model'=>$model));
	}
	
	public function actionDashbord()
	{
		$this->layout = '//layouts/column1';
		$model = new AttendanceReport();
		$reports = $model->departmentOT();
		$department = array();
		$OT = array();
		foreach ($reports as $report)
		{
			$department[] = $report['department'];
			$OT[] = (integer)$report['OT'];
		}
		$monthlyDepartmentalOT = array('department'=>$department, 'OT'=>$OT);
		unset ($department);

		//Declare for preventing error when there have no data
		$reports = $model->MonthlyDepartmentAttendance();
		$department = array();
		$regular = array();
		$absent = array();
		$late_in = array();
		$early_out = array();
		$on_leave = array();
		foreach ($reports as $report)
		{
			$department[] = $report['department'];
			$regular[] = (integer)$report['regular'];
			$absent[] = (integer)$report['absent'];
			$late_in[] = (integer)$report['late_in'];
			$early_out[] = (integer)$report['early_out'];
			$on_leave[] = (integer)$report['on_leave'];
		}
		$monthlyDepartmentalAttendance = array('department'=>$department, 'regular'=>$regular,
			'absent'=>$absent, 'late_in'=>$late_in, 'early_out'=>$early_out, 'on_leave'=>$on_leave);

		$reports = $model->lastDayAttendanceSummery();

		$this->render('summery', array('monthlyDepartmentalOT'=>$monthlyDepartmentalOT,
			'monthlyDepartmentalAttendance'=>$monthlyDepartmentalAttendance,
			'lastDayAttendanceSummery'=>$reports));
	}

	public function actionDaily($date=null, $dept=null, $shift=null){
		$model = new AttendanceFinalData();
		$model->unsetAttributes();
		if(isset($_POST['AttendanceFinalData'])){
			$model->setAttributes($_POST['AttendanceFinalData']);
		}
		$model->date = $date ? $date : $model->date;
		$model->core_department_id = $dept ? $dept : $model->core_department_id;
		$model->core_shift_id = $shift ? $shift : $model->core_shift_id;
		$this->render('daily', array('model'=>$model));
	}

	public function generateExcel($all_attendance_data,$date)
	{
		

			$absent=0;
			$present=0;
			$latein=0;
			$dayoff=0;
			$earlyOut=0;
			$LC=0;
			$LS=0;
			$k=1;
			if($all_attendance_data)
			{
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getActiveSheet()->setCellValue('A1','SN');
				$objPHPExcel->getActiveSheet()->setCellValue('B1','ID No');
				$objPHPExcel->getActiveSheet()->setCellValue('C1','Name');
				$objPHPExcel->getActiveSheet()->setCellValue('D1','Designation');

				$objPHPExcel->getActiveSheet()->setCellValue('E1','Department');
				$objPHPExcel->getActiveSheet()->setCellValue('F1','Date');
				
				$objPHPExcel->getActiveSheet()->setCellValue('G1','Shift');
				
				$objPHPExcel->getActiveSheet()->setCellValue('H1','In Time');
				$objPHPExcel->getActiveSheet()->setCellValue('I1','Out Time');
				
				$objPHPExcel->getActiveSheet()->setCellValue('J1','Remarks');
						
				$i=2;
				foreach($all_attendance_data as $attendance):
					$objPHPExcel->getActiveSheet()->setCellValue('A'. $i,$k++);
					$objPHPExcel->getActiveSheet()->setCellValue('B'. $i,$attendance->core_employee_id);
					$objPHPExcel->getActiveSheet()->setCellValue('C'. $i,$attendance->core_employee_name);
					$objPHPExcel->getActiveSheet()->setCellValue('D'. $i,$attendance->employee->designation);
					$objPHPExcel->getActiveSheet()->setCellValue('E'. $i,$attendance->core_department_name);
					$objPHPExcel->getActiveSheet()->setCellValue('F'. $i,$date);
					
					$objPHPExcel->getActiveSheet()->setCellValue('G'. $i,$attendance->core_shift_name);
					
					$objPHPExcel->getActiveSheet()->setCellValue('H'. $i,$attendance->in_time?date("H:i:s",strtotime($attendance->in_time)):"NA" );
					$objPHPExcel->getActiveSheet()->setCellValue('I'. $i,$attendance->out_time?date("H:i:s",strtotime($attendance->out_time)):"NA");
					
					$objPHPExcel->getActiveSheet()->setCellValue('J'. $i,$attendance->status);
					
					
					$st=explode(" ",$attendance->status);
					
					if(in_array("A", $st)) $absent++;
					if(in_array("P", $st)) $present++;
					if(in_array("L", $st)) $latein++;
					if(in_array("X", $st)) $dayoff++;
					if(in_array("O", $st)) $dayoff++;
					if(in_array("E", $st)) $earlyOut++;
					if(in_array("LS", $st)) $LS++;
					if(in_array("LC", $st)) $LC++;
					
					
					$totalemp=$i-1;
					
					$i++;
					
				endforeach;
				 
				 $i=$i+3;
				 $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Total Employee");
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$totalemp);
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Total Present");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$present);
				 
				  $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Total Absent");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$absent);
				 
				  $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Total Late In");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$latein);
				 
				  $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Total Day Off");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$dayoff);
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Early Out");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$earlyOut);
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Sick Leave");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$LS);
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,"Casual Leave");
				 
				 $objPHPExcel->getActiveSheet()->setCellValue('C'. $i++,$LC);
				 
				 
				  //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
				  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
				  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(24);
				  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(24);
				  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(24);
				  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(24);
				  
				  $styleArray = array(
							'borders' => array(
								'outline' => array(
									'style' => PHPExcel_Style_Border::BORDER_THICK,
									'color' => array('argb' => '00000000'),
								),
							),
						);
						
				/*$dir="protected/attendance_attachment/". date("Y/m/d/",strtotime($date));
				
				if(!is_dir($dir))
				mkdir($dir);
				
				*/
				
				$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);

				  
				 //$filename = $dir."/attendance_".str_replace(" ","_",$group)."_".$date.".xlsx";
				 
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="attendance_'.$date.'.xlsx"');
				header('Cache-Control: max-age=0');  

				$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
				$writer->save('php://output');
				
				/*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				//$objWriter->save($filename);  //push out to the client browser
				$writer->save('php://output');*/
				
				
				//return $filename;
			}
			
		
		
	}
	public function actionDownload($date=null, $dept=null, $shift=null){
		$model = new AttendanceFinalData();
		$model->unsetAttributes();
		
		if(isset($_POST['yt1'])){
		
			
			$model->setAttributes($_POST['AttendanceFinalData']);
			
			$query="";
			$sn=0;
			
			if($model->core_department_id)
			{$query .=" core_department_id=".$model->core_department_id;$sn=1;}
			
			if($model->core_shift_id)
			{
			if($sn==1)
			$query .=" AND core_shift_id=".$model->core_shift_id;
			else $query .=" core_shift_id=".$model->core_shift_id;
			}
			
			
			//echo $query; die();
			
			//echo $query; die();
			//echo $model->date; die();
			
			if($query)
			$all_attendance_data=AttendanceFinalData::model()->findAll("date='$model->date' and ( $query ) order by core_employee_id ASC");
			
			else
			$all_attendance_data=AttendanceFinalData::model()->findAll("date='$model->date'  order by core_employee_id ASC");
			
			//echo count($all_attendance_data)." ";
			//print_r($all_attendance_data); die();
			
			if($all_attendance_data)
			{
					
				   //if($notification->department_to_group)	 
				   //$department=$p++;
				   //else $department="";
						
				$filepath=$this->generateExcel($all_attendance_data,$model->date);
				
				

 
			}
			
		}
		
		if(isset($_POST['AttendanceFinalData'])){
			$model->setAttributes($_POST['AttendanceFinalData']);
			
			
			
		}
		
		$model->date = $date ? $date : $model->date;
		$model->core_department_id = $dept ? $dept : $model->core_department_id;
		$model->core_shift_id = $shift ? $shift : $model->core_shift_id;
		$this->render('download', array('model'=>$model));
	}
	
	public function actionSummary(){
		$model = new AttendanceFinalData();
		$model->unsetAttributes();
		if(isset($_POST['AttendanceFinalData'])){
			$model->setAttributes($_POST['AttendanceFinalData']);
		}
		$this->render('summary', array('model'=>$model));
	}
        
        
        public function actionAttendanceSummary(){
		$model = new AttendanceFinalData();
		$model->unsetAttributes();
		if(isset($_POST['AttendanceFinalData'])){
			$model->setAttributes($_POST['AttendanceFinalData']);
		}
		$this->render('attendanceSummary', array('model'=>$model));
	}

	public function actionEntries($id){
		$model = AttendanceFinalData::model()->findByPk($id);
		if(Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
				'status'=>'success',
				'div'=>$this->renderPartial('entries', array('model'=>$model), true),
			));
			exit;
		}
	}
}
