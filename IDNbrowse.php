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
	include("sql.php");
	//$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
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
		//整個流程：初始化→放資料→加一些設定(如果有需要)→畫圖 
		/*	
			參考資料
			Google Chart API 
			https://developers.google.com/chart/interactive/docs/reference
			搜尋 ：DataTable.setValue
		*/
		//可以嘗試看看函式化，不難但是很繁瑣
	
		//網頁讀取到javascript囉！不要亂echo
		echo "<script type='text/javascript'>
				google.setOnLoadCallback(drawChart);
			function drawChart() {
					var PtosisData = new google.visualization.DataTable();
					PtosisData.addColumn('string','測驗日期');
					PtosisData.addColumn('number','Ptosis分數');
					PtosisData.addRows($countofRecords);
					var OphthalmoparesisData = new google.visualization.DataTable();
					OphthalmoparesisData.addColumn('string','測驗日期');
					OphthalmoparesisData.addColumn('number','Ophthalmoparesis分數');
					OphthalmoparesisData.addRows($countofRecords);
					var Facial_mucles_scoreData = new google.visualization.DataTable();
					Facial_mucles_scoreData.addColumn('string','測驗日期');
					Facial_mucles_scoreData.addColumn('number','Facial_mucles分數');
					Facial_mucles_scoreData.addRows($countofRecords);
					var Chewing_scoreData = new google.visualization.DataTable();
					Chewing_scoreData.addColumn('string','測驗日期');
					Chewing_scoreData.addColumn('number','Chewing分數');
					Chewing_scoreData.addRows($countofRecords);					
					var Swallowing_scoreData = new google.visualization.DataTable();
					Swallowing_scoreData.addColumn('string','測驗日期');
					Swallowing_scoreData.addColumn('number','Swallowing分數');
					Swallowing_scoreData.addRows($countofRecords);
					var OutStrTimeArmData = new google.visualization.DataTable();
					OutStrTimeArmData.addColumn('string','測驗日期');
					OutStrTimeArmData.addColumn('number','OutStrTimeArm分數');
					OutStrTimeArmData.addRows($countofRecords);
					var OutStrTimeLegData = new google.visualization.DataTable();
					OutStrTimeLegData.addColumn('string','測驗日期');
					OutStrTimeLegData.addColumn('number','OutStrTimeLeg分數');
					OutStrTimeLegData.addRows($countofRecords);
					var VitalData = new google.visualization.DataTable();
					VitalData.addColumn('string','測驗日期');
					VitalData.addColumn('number','Vital分數');
					VitalData.addRows($countofRecords);
					var GripData = new google.visualization.DataTable();
					GripData.addColumn('string','測驗日期');
					GripData.addColumn('number','Grip分數');
					GripData.addRows($countofRecords);
					var TotalData = new google.visualization.DataTable();
					TotalData.addColumn('string','測驗日期');
					TotalData.addColumn('number','總分數(越低越好)');
					TotalData.addRows($countofRecords);
					";
					
					
				
		while($eachrow = $result->fetch_assoc()){
			
			if($countofRecords==0)break;
			//print_r($eachrow); debug用 要用請脫離script再Debug
			//echo "<br>";	
			// ' ' string type小分號漏掉就悲劇
			echo "PtosisData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "PtosisData.setValue(".$index.",1,".$eachrow['Ptosis'].");";
	
		
			echo "OphthalmoparesisData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "OphthalmoparesisData.setValue(".$index.",1,".$eachrow['Ophthalmoparesis'].");";
			
			echo "Facial_mucles_scoreData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "Facial_mucles_scoreData.setValue(".$index.",1,".$eachrow['Facial_mucles_score'].");";
			
			echo "Chewing_scoreData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "Chewing_scoreData.setValue(".$index.",1,".$eachrow['Chewing_score'].");";
			
			echo "Swallowing_scoreData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "Swallowing_scoreData.setValue(".$index.",1,".$eachrow['Swallowing_score'].");";
			
			echo "OutStrTimeArmData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "OutStrTimeArmData.setValue(".$index.",1,".$eachrow['OutStrTimeArm'].");";
			
			echo "OutStrTimeLegData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "OutStrTimeLegData.setValue(".$index.",1,".$eachrow['OutStrTimeLeg'].");";
			
			echo "VitalData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "VitalData.setValue(".$index.",1,".$eachrow['Vital'].");";
			
			echo "GripData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "GripData.setValue(".$index.",1,".$eachrow['Grip'].");";
			
			echo "TotalData.setValue(".$index.",0,'".$eachrow['recordDate']."');"; 
			echo "TotalData.setValue(".$index.",1,".$eachrow['Total'].");";

			$countofRecords--;
			$index++;
		}
		echo "var options_Ptosis = {
					  title: 'Ptosis曲線圖'
			};
			var options_Ophthalmoparesis = {
					  title: 'Ophthalmoparesis曲線圖'
			};
			var options_Facial_mucles = {
					  title: 'Facial_mucles曲線圖'
			};
			var options_Chewing = {
					  title: 'Chewing曲線圖'
			};
			var options_Swallowing = {
					  title: 'Swallowing曲線圖'
			};
			var options_OutStrTimeArm = {
					  title: 'OutStrTimeArm曲線圖'
			};
			var options_OutStrTimeLeg = {
					  title: 'OutStrTimeLeg曲線圖'
			};
			var options_Vital = {
					  title: 'Vital曲線圖'
			};
			var options_Grip = {
					  title: 'Grip曲線圖'
			};
			var options_Total = {
					  title: 'Total曲線圖'
			};

			var Ptosis_chart = new google.visualization.LineChart(document.getElementById('chart_Ptosis'));
			Ptosis_chart.draw(PtosisData, options_Ptosis);
			var Ophthalmoparesis_chart = new google.visualization.LineChart(document.getElementById('chart_Ophthalmoparesis'));
			Ophthalmoparesis_chart.draw(OphthalmoparesisData, options_Ophthalmoparesis);
			var Facial_mucles_chart = new google.visualization.LineChart(document.getElementById('chart_Facial_mucles'));
			Facial_mucles_chart.draw(Facial_mucles_scoreData, options_Facial_mucles);
			var Chewing_chart = new google.visualization.LineChart(document.getElementById('chart_Chewing'));
			Chewing_chart.draw(Chewing_scoreData, options_Chewing);
			var Swallowing_chart = new google.visualization.LineChart(document.getElementById('chart_Swallowing'));
			Swallowing_chart.draw(Swallowing_scoreData, options_Swallowing);
			var OutStrTimeArm_chart = new google.visualization.LineChart(document.getElementById('chart_OutStrTimeArm'));
			OutStrTimeArm_chart.draw(OutStrTimeArmData, options_OutStrTimeArm);
			var OutStrTimeLeg_chart = new google.visualization.LineChart(document.getElementById('chart_OutStrTimeLeg'));
			OutStrTimeLeg_chart.draw(OutStrTimeLegData, options_OutStrTimeLeg);
			var Vital_chart = new google.visualization.LineChart(document.getElementById('chart_Vital'));
			Vital_chart.draw(VitalData, options_Vital);
			var Grip_chart = new google.visualization.LineChart(document.getElementById('chart_Grip'));
			Grip_chart.draw(GripData, options_Grip);
			var Total_chart = new google.visualization.LineChart(document.getElementById('chart_Total'));
			Total_chart.draw(TotalData, options_Total);
			
			}
			</script>";
		
		echo "<br>";
		
	}
	else
	{
		echo "此身分院方尚未新增";	
	}
	$result->close();


?>



</body>
