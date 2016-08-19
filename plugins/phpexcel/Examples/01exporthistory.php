<?php
session_start();
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
require '../../../config/dbconnect.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Yoga Bayu Aji Pranawa")
							 ->setLastModifiedBy("Yoga Bayu Aji Pranawa")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("History result file");


$reqdate=$_POST['reqdate'];
$date=explode(" - ", $reqdate);
$fromdate=date("Y-m-d",strtotime($date[0]));
$todate=date("Y-m-d",strtotime($date[1]));

$sql="SELECT * FROM request WHERE request_date>='".$fromdate."' AND request_date<='".$todate."' AND requester_id='".$_SESSION['username']."' ";
$result=mysqli_query($conn,$sql);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Request ID')
            ->setCellValue('B1', 'Requester ID')
            ->setCellValue('C1', 'Station Origin')
            ->setCellValue('D1', 'Central Planner ID')
            ->setCellValue('E1', 'Central Planner Note')
            ->setCellValue('F1', 'Provider ID')
            ->setCellValue('G1', 'Provider Station')
            ->setCellValue('H1', 'Unit ID')
            ->setCellValue('I1', 'Provider Note')
            ->setCellValue('J1', 'Total Requirements')
            ->setCellValue('K1', 'Customer ID')
            ->setCellValue('L1', 'Request Date')
            ->setCellValue('M1', 'Approved Date')
            ->setCellValue('N1', 'Start Request')
            ->setCellValue('O1', 'End Request')
            ->setCellValue('P1', 'Request Status')
            ->setCellValue('Q1', 'Reason')
            ->setCellValue('R1', 'Reimburstment');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Export History');

$x=2;
while ($row=mysqli_fetch_array($result)) {
	$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$x,$row['request_id'])
				->setCellValue('B'.$x,$row['requester_id'])
				->setCellValue('C'.$x,$row['station_origin'])
				->setCellValue('D'.$x,$row['centralplanner_id'])
				->setCellValue('E'.$x,$row['centralplanner_msg'])
				->setCellValue('F'.$x,$row['provider_id'])
				->setCellValue('G'.$x,$row['station_provider'])
				->setCellValue('H'.$x,$row['unit_id'])
				->setCellValue('I'.$x,$row['provider_msg'])
				->setCellValue('J'.$x,$row['request_total'])
				->setCellValue('K'.$x,$row['customer_id'])
				->setCellValue('L'.$x,date("Y-m-d", strtotime($row['request_date'])))
				->setCellValue('M'.$x,date("Y-m-d", strtotime($row['approved_date'])))
				->setCellValue('N'.$x,date("Y-m-d", strtotime($row['start_date'])))
				->setCellValue('O'.$x,date("Y-m-d", strtotime($row['finish_date'])))
				->setCellValue('P'.$x,$row['status_request'])
				->setCellValue('Q'.$x,$row['reason'])
				->setCellValue('R'.$x,$row['reimburstment']);
	$x++;
}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
$date=date("Y-m-d");
header('Content-Disposition: attachment;filename="history"'.$date.'".xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
