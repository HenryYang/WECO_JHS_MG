<?php
	//debug用
	//print_r($_GET); ->jqGrid (使用到AJAX)有點像是訊號控制的概念
	//php 回傳純粹JSON 就回傳純粹JSON 不要亂加東西 不要產生HTMLTAG
	//盡量先了解AJAX的結構會比較容易看懂
	
	/*
	前端丟來這的資料 (第一次的搜尋)
	EXAMPLE:
	Array
	(
    [MRN] => 12345678
    [_search] => false
    [nd] => 1367310880478
    [rows] => 10
    [page] => 1
    [sidx] => timestamp
    [sord] => desc
	)
	
	//如果讓他按下搜尋(同等於進階搜尋) sex 不等於10
	Array
	(
    [MRN] => 12345678
    [_search] => true
    [nd] => 1367311124205
    [rows] => 10
    [page] => 1
    [sidx] => timestamp
    [sord] => desc
    [searchField] => sex
    [searchString] => 10
    [searchOper] => ne
    [filters] => 
	)
	重點是他後端沒幫你寫好進階搜尋 進階搜尋這邊要自己寫
	比如說~ 要做個判斷式 
	if($_GET[_search]==true){
		
			SELECT COUNT(*) AS count FROM mgscore WHERE MRN = $_GET[MRN] & $_GET[searchField] $_GET[searchOper] $_GET[searchString]
			SELECT * FROM mgscore WHERE MRN=$_GET[MRN]  & $_GET[searchField] $_GET[searchOper] $_GET[searchString] ORDER BY $sidx $sord LIMIT $start , $limit
			
			//重點來囉→ $_GET[searchOper] 要根據他轉過來的代號 轉換成運算符號 
			//以這個例子來說 ne 就要轉換成 != 
			//至於所有的searchOper 對應到甚麼mysql的運算符號 可以用 print_r($_GET)來檢查囉!
			
		}
		
	}
	
	*/
	
	//資料剖析
	$page = $_GET['page']; // get the requested page
	$limit = $_GET['rows']; // get how many rows we want to have into the grid
	$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 搜尋名稱
	$sord = $_GET['sord']; // get the direction
	if(!$sidx) $sidx =1;
	// connect to the database
	include("sql.php");
	//$mysqli = new mysqli("localhost", "mg", "welovemei", "mg");
	$mysqli->set_charset("utf8");
	$sqlcount = "SELECT COUNT(*) AS count FROM mgscore WHERE MRN = $_GET[MRN]";
	$result1 = mysqli_query($mysqli,$sqlcount);
	$row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
	$count = $row['count'];

	if( $count >0 ) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit; // do not put $limit*($page - 1)
	$SQL = "SELECT * FROM mgscore WHERE MRN=$_GET[MRN] ORDER BY $sidx $sord LIMIT $start , $limit";
	$result2 = mysqli_query($mysqli,$SQL) or die("Error: ".mysqli_error($mysqli));;
	//接下來要組織訊息，準備丟回前端
	$responce= new stdClass(); //必要的基本物件宣告就跟array使用前要New一樣
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$i=0;
	//抓取需要呈現的資料丟至前端
	while($row = mysqli_fetch_array($result2 ,MYSQLI_ASSOC)) {
		$responce->rows[$i]['id']="".$i;
		$responce->rows[$i]['cell']=array($row['recordDate'],$row['Ptosis'],$row['Ophthalmoparesis'],$row['Facial_mucles_score'],$row['Chewing_score'],$row['Swallowing_score'],$row['OutStrTimeArm_Score']
		,$row['OutStrTimeLeg_Score'],$row['Vital_score'],$row['Grip_score'],$row['Total'],$row['timestamp']);
		$i++;
	}        
	//json格式化後傳出
	echo json_encode($responce);
?>
