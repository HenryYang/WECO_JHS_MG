<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
// 這個頁面負責用來處理更新資料(較難寫的部分)
?>
<script> 

function AutoSubmit()
	{
		/*老師沒教的事：
		 *所有物件的ID NAME 或 function 不要取名為Submit 不然會很悲劇~
		 *document.表單名稱.submit(); 即可，之前的那個方式並沒有啟動Submit
		 *有了它，連submit button都不用
		*/
		document.getElementById('form1').submit();
		

	}
 
</script>
</head>
<body onload="AutoSubmit()">
<?php
	
	//重新計算分數
	$OSTA90_score = 0;
	$OSTL45_score = 0;
	$Vital_score  = 0;
	$Grip_score   = 0;
	$Total 		  = 0;
	//Outstretch timearm -90˙standing(sec) ,$OSTA90_score
	if($_POST['OutStrTimeArm90']>240){
		$OSTA90_score=0;
		//echo "<br />";
		//echo $OSTA90_score;
	}
	
	else if($_POST['OutStrTimeArm90']>=90&&$_POST['OutStrTimeArm90']<=240){
		$OSTA90_score=1;
		//echo "<br />";
		//echo $OSTA90_score;
	}
	else if($_POST['OutStrTimeArm90']>=10&&$_POST['OutStrTimeArm90']<90){
		$OSTA90_score=2;
		//echo "<br />";
		//echo $OSTA90_score;
	}
	else if($_POST['OutStrTimeArm90']<10){
		$OSTA90_score=3;
		//echo "<br />";
		//echo $OSTA90_score;
	}
	else {
		echo "Outstretch timearm -90˙standing(sec)輸入格式不正確";
	}
	
	//Outstretch time leg -45˙supine (sec) , $OSTL45_score
	if($_POST['OutStrTimeLeg45']>100){
		$OSTL45_score=0;
		//echo "<br />";
		//echo $OSTL45_score;
	}
	
	else if($_POST['OutStrTimeLeg45']>=30&&$_POST['OutStrTimeLeg45']<=100){
		$OSTL45_score=1;
		//echo "<br />";
		//echo $OSTL45_score;
	}
	else if($_POST['OutStrTimeLeg45']>0&&$_POST['OutStrTimeLeg45']<30){
		$OSTL45_score=2;
		//echo "<br />";
		//echo $OSTL45_score;
	}
	else if($_POST['OutStrTimeLeg45']==0){
		$OSTL45_score=3;
		//echo "<br />";
		//echo $OSTL45_score;
	}
	else {
		echo "Outstretch time leg -45˙supine (sec)輸入格式不正確";
	}
	//Vital capacity (L) 	, $Vital_score
	switch($_POST['sex']){
	//1 = male
		case 1: {
			if($_POST['Vital']>=3.5){
				$Vital_score=0;
				//echo "<br />";
				//echo $Vital_score;
			}
			
			else if($_POST['Vital']>=2.5&&$_POST['Vital']<3.5){
				$Vital_score=1;
				//echo "<br />";
				//echo $Vital_score;
			}
			else if($_POST['Vital']>=1.5&&$_POST['Vital']<2.5){
				$Vital_score=2;
				//echo "<br />";
				//echo $Vital_score;
			}
			else if($_POST['Vital']<1.5){
				$Vital_score=3;
				//echo "<br />";
				//echo $Vital_score;
			}
			else {
				echo "Vital capacity (L)輸入格式不正確";
			}
		}
		break;
		
		//2 = female
		case 2:{
			if($_POST['Vital']>=2.5){
				$Vital_score=0;
				//echo "<br />";
				//echo $Vital_score;
			}
			
			else if($_POST['Vital']>=1.8&&$_POST['Vital']<2.5){
				$Vital_score=1;
				//echo "<br />";
				//echo $Vital_score;
			}
			else if($_POST['Vital']>=1.2&&$_POST['Vital']<1.8){
				$Vital_score=2;
				//echo "<br />";
				//echo $Vital_score;
			}
			else if($_POST['Vital']<1.2){
				$Vital_score=3;
				//echo "<br />";
				//echo $Vital_score;
			}
			else {
				echo "Vital capacity (L)輸入格式不正確";
			}
			}
		break;
	}
	
	//Grip(kg):10th / 1st (%) ,$Grip_score
	if($_POST['Grip']<15){
		$Grip_score=0;
		//echo "<br />";
		//echo $Grip_score;
	}
	
	else if($_POST['Grip']>=15&&$_POST['Grip']<=30){
		$Grip_score=1;
		//echo "<br />";
		//echo $Grip_score;
	}
	else if($_POST['Grip']>30&&$_POST['Grip']<=75){
		$Grip_score=2;
		//echo "<br />";
		//echo $Grip_score;
	}
	else if($_POST['Grip']>75){
		$Grip_score=3;
		//echo "<br />";
		//echo $Grip_score;
	}
	else {
		echo "Grip(kg):10th / 1st (%)輸入格式不正確 ";
	}
	//TOTAL SCORE
	$Total 		  = $OSTA90_score + $OSTL45_score + $Vital_score + $Grip_score;
	include("sql.php");
	//$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
	$mysqli->set_charset("utf8");
	//UPDATE  `mg`.`mgscore` SET  `Ptosis` =  '215' WHERE  `mgscore`.`timestamp` =  '2013-04-30 18:40:55' AND  `mgscore`.`recordDate` =  '1977-04-01' AND  `mgscore`.`MRN` =12345678;
    
	
	$sql ="update mgscore set 
	recordDate= '$_POST[recordDate]', 
	Ptosis= '$_POST[Ptosis]', 
	Ophthalmoparesis = '$_POST[Ophthalmoparesis]', 
	Facial_mucles_score = '$_POST[Facial_muscles]', 
	Chewing_score = '$_POST[Chewing]', 
	Swallowing_score = '$_POST[Swallowing]', 
	OutStrTimeArm = '$_POST[OutStrTimeArm90]', 
	OutStrTimeArm_Score= '$OSTA90_score', 
	OutStrTimeLeg = '$_POST[OutStrTimeLeg45]', 
	OutStrTimeLeg_Score='$OSTL45_score', 
	Vital = '$_POST[Vital]', 
	Vital_score='$Vital_score', 
	Grip = '$_POST[Grip]', 
	Grip_score= '$Grip_score', 
	Total= '$Total', 
	Treatment = '$_POST[Treatment]', 
	AchRab= '$_POST[AchRab]', 
	PiMax= '$_POST[PiMax]', 
	Comment =  '$_POST[Comment]'
	where mgscore.timestamp =  '$_POST[timestamp]' AND  mgscore.recordDate =  '$_POST[recordDate]' AND  mgscore.MRN = '$_POST[MRN]';
	";
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$result = mysqli_query($mysqli, $sql);
	if($result){
	echo "</br>";
		echo "您的資料已成功更新";
	}
	else
	{
		echo "資料輸入失敗，請注意輸入格式是否正確";	
		echo "</br>";

		echo $mysqli->error;
		echo "</br>";

	}
	
	
	print_r($_POST);
	echo "</br>";
	echo "這邊就交給你啦! 下Update SQL即可,至於自動導回MRNBrowse.php 之前在mg_BackendforDrUpdate.php就有囉 !";
	echo "
		<form id='form1' name='form1' method='post' action='MRNbrowse.php'>
		<input name='MRN' type='hidden' value='$_POST[MRN]'>
		<input name='IDN' type='hidden' value='$_POST[IDN]'>
		<input name='name' type='hidden' value='$_POST[name]'>
		<input name='sex' type='hidden' value='$_POST[sex]'>
		<input name='birthday' type='hidden' value='$_POST[birthday]'>
		</form>";
?>

</body>
