<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
	<script src="js/jquery-ui.js" type="text/javascript"></script>
	<script src="js/grid.locale-tw.js" type="text/javascript"></script>
	<script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script src="js/jquery.jqGrid.src.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="jqcss/jquery-ui-1.10.2.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqcss/ui.jqgrid.css" />
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
</head>

<body>
	
<?php

	$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
	$mysqli->set_charset("utf8");
    $sql ="SELECT * from account where MRN = $_POST[MRN];";
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$result = mysqli_query($mysqli, $sql);
	$dataset=null;
	if($result){
		echo "您所查詢的資料";
		echo "<br>";
		$dataset = mysqli_fetch_assoc($result);
		foreach ($dataset as $last_record) {
			echo $last_record;
			echo "<br>";
		}

		echo "<br>";
	}
	else
	{
		echo "此病歷碼尚未新增";	
	}
	 print_r($_POST);
	 
echo "
<form id='form1' name='form1' method='post' action='MGscore.php'>
<br>
<input name='MRN' type='hidden' value='$dataset[MRN]'>
<input name='IDN' type='hidden' value='$dataset[IDN]'>
<input name='name' type='hidden' value='$dataset[name]'>
<input name='sex' type='hidden' value='$dataset[sex]'>
<input name='birthday' type='hidden' value='$dataset[birthday]'>
	<input name='Addsubmit' type='submit' class='locate' id='Addsubmit' value='新增資料' />



</form>";
	






?>

<br />
<table id="rowed3">	</table>
	<div id="prowed3"></div>

	
	
	<script type='text/javascript'>
	//post_to_url('mg_BackendforDrDelete.php', 0);
	var winW = document.body.clientWidth*0.9;
	//What the hell 搞不懂為什麼Script一定要放在 id 後才可以... = _________= 
	//colModel裡還可以設定每個欄位的參數 width , editable(預設false), align ,sortable(預設True)...
	//用ajax到後端拿資料
	jQuery("#rowed3").jqGrid({
	width: winW,
	height:400,

   	url:'backMRN.php?MRN=<?php echo $_POST['MRN']?>',
	datatype: "json",
    colNames:['紀錄日期','Ptosis', 'Ophthalmoparesis', 'Facial_mucles_score','Chewing_score','Swallowing_score','OutStrTimeArm_Score'
	,'OutStrTimeLeg_Score','Vital_score','Grip_score','Total','最後修改時間','刪除','編輯'],
   	colModel:[
   		{name:'recordDate',index:'recordDate', width:80},
   		{name:'Ptosis',index:'Ptosis', width:30},
   		{name:'Ophthalmoparesis',index:'Ophthalmoparesis', width:30},
   		{name:'Facial_mucles_score',index:'Facial_mucles_score', width:30},
   		{name:'Chewing_score',index:'Chewing_score', width:30},		
   		{name:'Swallowing_score',index:'Swallowing_score', width:30},		
   		{name:'OutStrTimeArm_Score',index:'OutStrTimeArm_Score', width:30},		
		{name:'OutStrTimeLeg_Score',index:'OutStrTimeLeg_Score', width:30},		
   		{name:'Vital_score',index:'Vital_score', width:30},		
   		{name:'Grip_score',index:'Grip_score', width:30},		
   		{name:'Total',index:'Total', width:30},		
   		{name:'timestamp',index:'timestamp', width:110},		
		{name:'delete',index:'timestamp', width:50},
		{name:'edit',index:'timestamp', width:50},
   	], 
  	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#prowed3',
   	sortname: 'recordDate',
    viewrecords: true,
    sortorder: "asc",
	editurl: "backMRN.php",
	caption: "MG結果列表",
	/*onSelectRow: function(id){ 
		//抓RowID
		alert("onSelectRow : "+ id + " has been called.");
		post_to_url('mgScore.php',id);
    },*/
	
	onCellSelect:function(rowid, iCol, cellcontent) {
		if(iCol==13){
			alert("編輯,這是第"+rowid+" row，這是第 "+iCol+" cell");
			post_to_url('MGscore.php',rowid,"post","0");
		}
		else if(iCol==12){
	
			var timestampcell = $('#rowed3').getCell(rowid, 11);
			alert("刪除,這是第"+rowid+" row，這是第 "+iCol+" cell，內容："+timestampcell);
			//var timestampvalue = getCellValue(timestampcell);
			post_to_url('mg_BackendforDrDelete.php',rowid,"post",timestampcell);
		}
	},
	loadComplete:function(rowid){
		var count=jQuery("#rowed3 tr").length;
		for(var i=0;i<count;i++){
			$("#rowed3").setCell(i,12,'delete',{background:'#FFCECD'});
			$("#rowed3").setCell(i,13,'edit',{background:'#E5FFCD'});
		}
	},
	
	});
	jQuery("#rowed3").jqGrid('navGrid',"#prowed3",{edit:false,add:false,del:false,search:false});
	
	
	$("#gbox_rowed3").css("margin","auto");//get this this and set its margin
	$(".ui-paging-info").css("margin-top","0");
	$("td").css("padding","0px");
	
// ('<a href="http://google.com.tw"> </a>'); 
	function post_to_url(path, id,method,value) {
			method = method || "post";// Set method to post by default if not specified.
			var form1 = document.createElement("form");
			form1.setAttribute("method", method);
			form1.setAttribute("action", path);
			//抓Row值
			var getJSONdata= jQuery("#rowed3").getRowData(id);
			//for(var key in 含多筆資料) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "recordDate");
				
				hiddenField.setAttribute("value", getJSONdata.recordDate);
				
				form1.appendChild(hiddenField);
			//}
			//create form content
			
			//var test=<?php echo $dataset['MRN'];?>;

			var MRN=document.createElement("input");
			MRN.setAttribute("type", "hidden");
			MRN.setAttribute("name", "MRN");
			MRN.setAttribute("value", "<?php echo $dataset['MRN'];?>");
			form1.appendChild(MRN);
			//
			var IDN=document.createElement("input");
			IDN.setAttribute("type", "hidden");
			IDN.setAttribute("name", "IDN");
			IDN.setAttribute("value", "<?php echo $dataset['IDN'];?>");
			form1.appendChild(IDN);
			//
			var name=document.createElement("input");
			name.setAttribute("type", "hidden");
			name.setAttribute("name", "name");
			name.setAttribute("value", "<?php echo $dataset['name'];?>");
			form1.appendChild(name);
			//
			var sex=document.createElement("input");
			sex.setAttribute("type", "hidden");
			sex.setAttribute("name", "sex");
			sex.setAttribute("value", "<?php echo $dataset['sex'];?>");
			form1.appendChild(sex);
			//
			var birthday=document.createElement("input");
			birthday.setAttribute("type", "hidden");
			birthday.setAttribute("name", "birthday");
			birthday.setAttribute("value", "<?php echo $dataset['birthday'];?>"	);
			form1.appendChild(birthday);
			//
			if(value!=0){
			
			var birthday=document.createElement("input");
			birthday.setAttribute("type", "hidden");
			birthday.setAttribute("name", "timestamp");
			birthday.setAttribute("value", value);
			form1.appendChild(birthday);
			}
			//
			var Addsubmit=document.createElement("input");
			Addsubmit.setAttribute("type", "submit");
			Addsubmit.setAttribute("name", "Addsubmit");
			Addsubmit.setAttribute("id", "Addsubmit");
			Addsubmit.setAttribute("value", "新增資料");
			form1.appendChild(Addsubmit);
			//
			

			document.body.appendChild(form1);
			form1.submit();
			
		}
	
	</script>
	
	<?php $result->close();?>
	

</body>
