<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>輸入病歷號碼</title>
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
		
		<form id="form1" name="form1" method="post" action="MRNbrowse.php" class="searchForm">
			<label class="searchLabel">請輸入病歷號碼：</label>
			<br>
			<br>
			<input class="searchText"type="text" name="MRN" id="MRN" />
			<br>
			<br>
			<input class="searchButton"type="submit" value="送出" />
		</form>
	</body>
</html>
