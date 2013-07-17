<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
//這個頁面建立完基本資料後，就會自動導向到mgscore.php新增第一筆資料
?>
<script> 

function AutoSubmit()
	{
		/*老師沒教的事：
		 *所有物件的ID NAME 或 function 不要取名為Submit 不然會很悲劇~
		 *document.表單名稱.submit(); 即可，之前的那個方式並沒有啟動Submit
		 *有了它，連submit button都不用
		*/
		document.form1.submit();


	}
 
</script>
</head>



<body onload="AutoSubmit()">
<?php

include("sql.php");	
	$MRN = $_POST['MRN'];
	$IDN = $_POST['IDN'];
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$birthday = $_POST['birthday'];
	
	$dataset = sprintf("'".$MRN."','".$IDN."','".$name."','".$sex."','".$birthday."'");
//	$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
	$mysqli->set_charset("utf8");
	$sql ="INSERT INTO account VALUES ($dataset);";
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$result = mysqli_query($mysqli, $sql);
	
	if($result){
		//看完就可以註解掉了 debug用
		echo $dataset;
		
		echo "
		<form id='form1' name='form1' method='post' action='MGscore.php'>
		<input name='MRN' type='hidden' value='$_POST[MRN]'>
		<input name='IDN' type='hidden' value='$_POST[IDN]'>
		<input name='name' type='hidden' value='$_POST[name]'>
		<input name='sex' type='hidden' value='$_POST[sex]'>
		<input name='birthday' type='hidden' value='$_POST[birthday]'>
		</form>";
		 
	}
	else{
		echo "error";

		
		
	}
	
?>

</body>
