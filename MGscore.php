<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
/* 
這個頁面負責用來讓使用者新增資料 
會有兩個可能的來源POST
一個是新增、一個是更新，所以會判斷是哪個資料源，再決定要將資料送到 mg_BackendforDr.php 新增 or mg_BackendforDrUpdate.php

*/
?>
<title>重症肌無力表格輸入</title>
			<link rel="stylesheet" href="/css/base.css" type="text/css" media="all" />
			<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.21/themes/base/jquery-ui.css" type="text/css" media="all" />
			<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
			<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
			<script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
			<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/minified/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>

<!-- CSS可以另外寫一個檔 看起來有點醜醜的 -->

<style type = "text/css">
			.container{
			border-right:1px solid #000;
			border-left:1px solid #000;
			border-radius:5px;
			width:1000px;
			margin:auto;
			}
			.layer1 { 
			border-top:1px solid #000;

			width:100%;
			margin:auto;
			height:30px;
			}
			.layer1_inner{
			background-color:#6F9;
			float:left;
			width:499px;
			}
			.layer2 {
			background-color:#0F0;
			}
			.layer2_inner{
				background-color:#CDE5FF;
			}
			.layer3 {
			background-color:#CFC;
			height:70px;
			border-top:1px solid #000;
			}
			.layer3_inner{
				background-color:#FFE7CD;
			}
			.left{
			border-right:1px solid #000;
			}
			.right{
			
			}
			.bottom{
			background-color:#FFCECD;
			border-top:1px solid #000;
			border-bottom:1px solid #000;
			}
			
		.locate {
			position: inherit;
			height: auto;
			width: 30%;
			margin-left: 35%;
			font-size: 150%;
			color: #33C;
			 
		}
		@media only screen 
		and (max-width : 800px){
			.container{
			width:100%;
			margin:auto;	
			
			}

			.layer1{
				width:100%;
				border-top:0px solid #000;
			}
			.layer1_inner{
				width:100%;
				border-top:1px solid #000;
			}
			.layer3{
				border-top:0px solid #000;
			}
			.left{
			}
		}
		@media only screen 
		and (min-width : 800px){
			.layer1_inner{
				height:100%;
			}

		}
</style>

<script>
		//這個技巧很常用，新增隱藏資訊到表單
		function addAttforForm1(att) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "timestamp");
				hiddenField.setAttribute("value", att );
				form1.appendChild(hiddenField);
		}
</script>

</head>

<body>

<?php
	/*錯誤訊息，不顯示，因為如果是新增，會發生$_POST['recordDate']不存在的ERROR
		有兩個改善方向
		第一個是讓兩個網頁都送$_POST['recordDate']的訊號過來，一個是null或-1，一個則是正常傳來的值
		第二個是另外寫一個網頁專門處理更新 意思就是本來是 兩個來源 -> mgscore.php -> 判斷要丟到哪個網頁做更新或新增
				變成獨立的 一個來源 -> 一個網頁 -> 一個動作
	*/
	ini_set("display_errors", "Off");
 if($_POST['recordDate'])
	{
		include("sql.php");
		//$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
		$mysqli->set_charset("utf8");
		$sql ="SELECT * from mgscore where MRN = '$_POST[MRN]' and recordDate = '$_POST[recordDate]'";
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$result  = mysqli_query($mysqli, $sql);
		$processdata = mysqli_fetch_assoc($result);
		echo "您要編輯的紀錄";
		print_r($processdata);
		$mysqli->close();
		
		
	}

?>

		<script>
			$(function() {
				$( "#recordDate" ).datepicker({
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

<header> 
<div id="Title">
  		<h3 align="center">
    	<strong>新光醫院重症肌無力紀錄系統</strong>
    	</h3>
  </div>
</header>

<?php
echo "院友基本資訊";
print_r($_POST);
?>
<?php 
 if($_POST['recordDate']) echo "<form id='form1' name='form1' method='post' action='mg_BackendforDrUpdate.php'>";
 else echo "<form id='form1' name='form1' method='post' action='mg_BackendforDr.php'>";
?>


<?php
//院友基本資訊
 echo "
		<input name='MRN' type='hidden' value='$_POST[MRN]'>
		<input name='IDN' type='hidden' value='$_POST[IDN]'>
		<input name='name' type='hidden' value='$_POST[name]'>
		<input name='sex' type='hidden' value='$_POST[sex]'>
		<input name='birthday' type='hidden' value='$_POST[birthday]'>";
?>
  <div class="container" align="left">
    <div class="layer1">
      <div class="layer1_inner left" scope="row">Date</div>
      <div class="layer1_inner">
	  <label>
 		<script>
			$(function() {
				$( "#recordDate" ).datepicker();
			});
		</script>


		<input type="text" name="recordDate" id="recordDate" value="<?php if($_POST['recordDate']) echo $_POST['recordDate'];else echo date("Y-m-d");?>">


      </label>
	  </div>
    </div>
	
	<div class="layer1">
      <div class="layer1_inner left" scope="row">sex</div>
      <div class="layer1_inner">
		<label>
		
		<?php 
		if($_POST['sex']==1) echo "Male";
		else echo "Female";
		?>
		
		</label>
		
      </div>
    </div>
    
	<div class="layer1">
      <div class="layer1_inner left" scope="row">Ptosis</div>
      <div class="layer1_inner"><label>
        <input type="text" name="Ptosis" id="Ptosis" value="<?php if($_POST['recordDate']) echo $processdata['Ptosis'];?>"/>
      </label></div>
    </div>
    <div class="layer1">
      <div class="layer1_inner left" scope="row">Ophthalmoparesis</div>
      <div class="layer1_inner right">
	  <input type="text" name="Ophthalmoparesis" id="Ophthalmoparesis" value="<?php if($_POST['recordDate']) echo $processdata['Ophthalmoparesis'];?>" /></div>
    </div>
    <div class="layer1">
      <div class="layer1_inner left"scope="row">Facial muscles</div>
      <div class="layer1_inner right"><label>
        <select name="Facial_muscles" id="Facial_muscles" >
			<option value="0" >Normal</option>
			<option value="1">Mild weakness on lid closure, snarl</option>
			<option value="2">Incomplete lid clousure</option>
			<option value="3">No mimic expression</option>
		</select>
      </label></div>
    </div>
    <div class="layer1">
      <div class="layer1_inner left" scope="row">Chewing</div>
      <div class="layer1_inner right"><label>
		<select name="Chewing" id="Chewing" >
			<option value="0" >Normal</option>
			<option value="1">Fatigue on chewing solid foods</option>
			<option value="2">Only soft foods</option>
			<option value="3">NG tube</option>
		</select>
      </label></div>
    </div>
    <div class="layer1">
      <div class="layer1_inner left" scope="row">Swallowing</div>
      <div class="layer1_inner right"><label>
  		<select name="Swallowing" id="Swallowing" >
			<option value="0" >Normal</option>
			<option value="1">Fatigue on normal foods</option>
			<option value="2">Incomplete palatal clousure,naslity</option>
			<option value="3">NG tube</option>
		</select>
      </label></div>
    </div>
    <div class="layer1 layer2"> 
      <div class="layer1_inner layer2_inner left" scope="row">Outstretch time<br />
        </div>
      <div class="layer1_inner layer2_inner right"><label>
        <input type="text" name="OutStrTimeArm90" id="OutStrTimeArm90" value="<?php if($_POST['recordDate']) echo $processdata['OutStrTimeArm'];?>"/>arm -90˙standing(sec)
      </label></div>
    </div>
    <div class="layer2 layer1"> 
      <div class="layer1_inner layer2_inner left" scope="row">Outstretch time<br />
        </div>
      <div class="layer1_inner layer2_inner right"><label>
        <input type="text" name="OutStrTimeLeg45" id="OutStrTimeLeg45" value="<?php if($_POST['recordDate']) echo $processdata['OutStrTimeLeg'];?>"/>leg -45˙supine (sec)
      </label></div>
    </div>
    <div class="layer1 layer2"> 
      <div class="layer1_inner layer2_inner left" scope="row">Vital capacity </div>
      <div class="layer1_inner layer2_inner right"><label>
        <input type="text" name="Vital" id="Vital" value="<?php if($_POST['recordDate']) echo $processdata['Vital'];?>"/>(L)
      </label></div>
    </div>
    <div class="layer2 layer1"> 
      <div class="layer1_inner layer2_inner left"scope="row">Grip(kg):<br />
        </div>
      <div class="layer1_inner layer2_inner right"><label>
        <input type="text" name="Grip" id="Grip" value="<?php if($_POST['recordDate']) echo $processdata['Grip'];?>"/>10th / 1st (%)
      </label></div>
    </div>

    <div class="layer3"> 
      <div class="layer1_inner layer3_inner left" scope="row">Treatment</div>
      <div class="layer1_inner layer3_inner right"><label>
        <textarea name="Treatment" id="Treatment" cols="30" rows="3" ><?php if($_POST['recordDate']) echo $processdata['Treatment'];?></textarea>
      </label></div>
    </div>
    <div class="layer3"> 
      <div class="layer1_inner layer3_inner left" scope="row">AchRAb-blood</div>
      <div class="layer1_inner layer3_inner right"><label>
        <textarea name="AchRab" id="AchRab" cols="30" rows="3" ><?php if($_POST['recordDate']) echo $processdata['AchRab'];?></textarea>
      </label></div>
    </div>
    <div class="layer3"> 
      <div class="layer1_inner layer3_inner left" scope="row">PiMax(cmH2O)</div>
      <div class="layer1_inner layer3_inner right"><label>
        <textarea name="PiMax" id="PiMax" cols="30" rows="3" ><?php if($_POST['recordDate']) echo $processdata['PiMax'];?></textarea>
      </label></div>
    </div>
    <div class="layer3"> 
      <div class="layer1_inner layer3_inner left" scope="row">Comments</div>
      <div class="layer1_inner layer3_inner right"><label>
        <textarea name="Comment" id="Comment" cols="30" rows="3" ><?php if($_POST['recordDate']) echo $processdata['Comment'];?></textarea>
      </label></div>
    </div>

	<div class="bottom">
		<?php 
		if($_POST['recordDate']) echo "<input name='submit' type='submit' class='locate' id='submit' value='確認更新' />";
		else echo "<input name='submit' type='submit' class='locate' id='submit' value='確認送出' />";
		?>
		
		<input name="Reset" type="reset" class="locate" id="Reset" value="重新輸入" />
	</div>
</div>
<?php
//這邊才做selected的判斷
if ($_POST['recordDate']){
		echo "<script>
				Facial_muscles[$processdata[Facial_mucles_score]].selected = true;
				Chewing[$processdata[Chewing_score]].selected = true;
				Swallowing[$processdata[Swallowing_score]].selected = true;
				addAttforForm1('$processdata[timestamp]');
				document.getElementById('form1').submit();
				</script>
				";
		}
?>

		
		
</form>

</body>
</html>
