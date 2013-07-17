<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body >
<h1>123</h1>
<?php
	print_r($_POST);
	echo "<br>";
	//錯誤訊息，不顯示
	//ini_set("display_errors", "Off");
 if($_POST['recordDate'])
	{
		include("sql.php");
		//$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
		$mysqli->set_charset("utf8");
		$sql ="DELETE from mgscore where MRN = ".$_POST['MRN']." and recordDate = '".$_POST['recordDate']."' and timestamp = '".$_POST['timestamp']."'" ;
		echo $sql;
		echo "<br>";
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$result  = mysqli_query($mysqli, $sql);
		//$processdata = mysqli_fetch_assoc($result);
		echo $result;
		$mysqli->close();
		
		
	}

?>
</body>
