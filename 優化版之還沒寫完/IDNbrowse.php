<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {packages:['corechart']});
</script>

</head>

<body>
<div id="chart_Ptosis" style="width: 900px; height: 500px;"></div>
<div id="chart_Ophthalmoparesis" style="width: 900px; height: 500px;"></div>
<div id="chart_Facial_mucles" style="width: 900px; height: 500px;"></div>
<div id="chart_Chewing" style="width: 900px; height: 500px;"></div>
<div id="chart_Swallowing" style="width: 900px; height: 500px;"></div>
<div id="chart_OutStrTimeArm" style="width: 900px; height: 500px;"></div>
<div id="chart_OutStrTimeLeg" style="width: 900px; height: 500px;"></div>
<div id="chart_Vital" style="width: 900px; height: 500px;"></div>
<div id="chart_Grip" style="width: 900px; height: 500px;"></div>
<div id="chart_Total" style="width: 900px; height: 500px;"></div>


<?php
	//初始值宣告
	$lastNumofRecords = 6; //Chart顯示最新的幾筆資料 預設顯示6筆
	$index=0; 
	
	//echo "SearchIDN.php傳過來的資料：";
	//print_r($_POST);
	//echo "<br>";
	$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
	$mysqli->set_charset("utf8");
    $sql ="SELECT * from mgscore where IDN = '$_POST[IDN]' order by recordDate desc;";
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$result  = mysqli_query($mysqli, $sql);
	//echo "SQL 結果：";
	//print_r($result);
	//echo "<br>";
	
	//紀錄有幾筆資料
	$NumofRecords = $result->num_rows;
	//判斷Chart能顯示的筆數
	if($lastNumofRecords>$NumofRecords)	$countofRecords = $NumofRecords;
	else $countofRecords = $lastNumofRecords;
	
	//echo "result資料處理：";
	//$processSQL = mysqli_fetch_all($result);
	//print_r($processSQL);
	//echo "<br>";

	
	/*
	Google Chart API 
	https://developers.google.com/chart/interactive/docs/reference
	搜尋 ：DataTable.setValue
	*/
	print_r($result);
	/*while($testeachrow = $result->fetch_assoc())
	{
	print_r($testeachrow);
	echo "<br>";
	echo $testeachrow['recordDate'];
	}
	*/
	if($result){
		//echo "您所查詢的資料";
		//網頁讀取到javascript囉！不要亂echo
		echo "<script type='text/javascript'>
				google.setOnLoadCallback(drawChart);
				var DataChart = new array();
				var options = new array();
				var divName = new array();
				
			function initialChart(indexofChart,kind){
					divName[indexofChart] = kind + '_chart';
					var divTag = document.createElement('div');
					divTag.id = divName[indexofChart];
			//kind 種類名稱 如 ptosis
					DataChart[indexofChart] = new google.visualization.DataTable();
					DataChart[indexofChart].addColumn('string','測驗日期');
					DataChart[indexofChart].addColumn('number',kind);
					DataChart[indexofChart].addRows($countofRecords);		
			}
			
			function putDatainChart(indexofChart,kind,kindvalue,indexofDate,recordDate){
					//kindvalue 如ptosis值
					DataChart[indexofChart].setValue(indexofDate,0,recordDate); 
					DataChart[indexofChart].setValue(indexofDate,1,kindvalue);
					var optionsName = kind+'曲線圖';
					options[indexofChart] = {
					  title: optionsName
					};
	
			}
			
			function realDraw(indexofChart){
					var drawingchart = new google.visualization.LineChart(document.getElementById(divName[indexofChart]));
					drawingchart.draw(DataChart[indexofChart], options[indexofChart]);
			}
			
			
			</script>";
		while($eachrow = $result->fetch_assoc()){
			echo "<script type='text/javascript'>
				putDatainChart($index,,,$eachrow['recordDate'])
			</script>";
			$countofRecords--;
			$index++;
		}	
		
		
		echo "<br>";
		
	}
	else
	{
		echo "此身分院方尚未新增";	
	}
	$result->close();


?>



</body>