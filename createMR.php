<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>新增院友病歷</title>
		<script src="js/jquery-1.9.1.js"></script>
		<script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css">
		<link rel="stylesheet" href="css/layout.css">
		<script>
			$(function() {
				$( "input[type=submit], a, button" ).button().click(function( event ) {
					
				});
			});

		</script>
	</head>

	<body>
		<script>
			$(function() {
				$( "#birthday" ).datepicker({
					yearRange : "-100:+0",
					dateFormat : "yy-mm-dd",
					changeMonth: true,
					changeYear: true,
					defaultDate : (new Date(new Date().getFullYear() - 20
                                + "/01/01") - new Date())
                                / (1000 * 60 * 60 * 24)
				});
			});
			
		</script>
		<br>
		<br>
		<center><label class="searchLabel" style="font-size:40px;margin:auto;font-weight: bold;">建立院友病歷資料</label></center>
		<form id="createMR" name="createMR" method="post" action="backCreateMR.php" class="searchForm">
		<div>
			<label class="searchLabel">病歷號碼：
			<br>
			<br>
			<input class="searchText"type="text" name="MRN" id="MRN"></label>
			<br>
			<br>
			<label class="searchLabel">身分證字號：
			<br>
			<br>
			<input class="searchText"type="text" name="IDN" id="IDN"></label>
			<br>
			<br>
			<label class="searchLabel">姓名：
			<br>
			<br>
			<input class="searchText"type="text" name="name" id="name"></label>
			<br>
			<br>
			<label class="searchLabel">性別：
			<br>
			<br>
			<select class="searchText" id="sex" name="sex">
				<option value="1">男</option>
				<option value="2">女</option>
			</select></label>
			<br>
			<br>
			<label class="searchLabel">生日：
			<br>
			<br><!-- 還需要改!!!-->
			<input type="text" class="searchText" name="birthday" id="birthday" value=""></label>
			<br>
			<br><br>
			<input class="searchButton" name="submit" type="submit" id="submit" value="確認送出">
		</div>
		</form>
	</body>
</html>