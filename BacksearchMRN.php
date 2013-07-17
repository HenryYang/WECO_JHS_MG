<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

	</head>

	<body>
	
		<?php
		//這個網頁好像沒有用到...當初是拿來測試的，可刪
			$MRN = (int)$_POST['MRN'];
			include("sql.php");
			//$mysqli=mysqli_connect("localhost","mg","welovemei","mg");
			if (mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			
			$result = mysqli_query($mysqli,"SELECT * FROM account WHERE MRN='123456789'");
			$row = mysqli_fetch_array($result);

			print_r($row['MRN']);

			mysqli_close($mysqli);
		?>

	</body>
</html>
