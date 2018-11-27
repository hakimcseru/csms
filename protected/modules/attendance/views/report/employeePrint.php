<?php
/* @var $employee CoreEmployee */
/* @var $model AttendanceFinalData */

$department = @$employee->department->core_department_name;
$shift = @$employee->shift->core_shift_name;
$this->renderPartial('_employeeGrid', array('model'=>$model));
