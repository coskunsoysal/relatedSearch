<?php
header('Content-Type: text/html; charset=utf-8');

include("simple_html_dom.php");

$link = mysql_connect('localhost', 'root', 'root');
  		mysql_select_db('related_search'); 

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php

if($_GET['searchKeyword']){
	$searchKeyword = $_GET['searchKeyword'];

	$deleteAll = "DELETE FROM related_search WHERE 1";
	$result = mysql_query ($deleteAll); 

	$insertSQL = "INSERT INTO related_search (id, searched_keyword) VALUES (0,'$searchKeyword')";
	$result = mysql_query ($insertSQL); 

}else{
?>
<form action='' method='get'>
  <div class="form-group">
    <label for="searchKeyword">Aranacak Kelime:</label>
    <input type="searchKeyword" class="form-control" id="searchKeyword" name="searchKeyword">
  </div>
  <button type="submit" class="btn btn-default">Gönder</button>
</form>
<?php
exit();
}

$i = 0;
$selectLastID['id'] = 0;
while($i < 25) {
	$strSQL = "SELECT * FROM related_search WHERE id='$i'"; 
	$result = mysql_query ($strSQL); 

	$returnArray = mysql_fetch_array($result);
	$keyword = str_replace(" ", "+", $returnArray['searched_keyword']);

	$keywordList = [];

	// Create DOM from URL or file
	$html = file_get_html('https://www.google.com.tr/search?q='.$keyword.'&*#safe=off&q='.$keyword.'&*');
	$rvh = $html->find('div[class=_rvh]');

	if(!$rvh){
		$i++;
		continue;
	}

	foreach ($rvh as $key => $value) {
		if(strpos($value, "Kullanıcılar şunları da aradı")){
			$strictKey = $key;
		}
	}

	$rvh = $html->find('div[class=_rvh]',$strictKey)->find('div[class=_wSe] a');

	/// Find all related search 
	foreach($rvh as $id => $element){
        $keywordList[] = $element->innertext;
    }


    if($selectLastID['id']<25){
	    foreach ($keywordList as $keyword) {
	    		
	    		$selectLastID = $result = mysql_query("SELECT id FROM related_search ORDER BY id DESC LIMIT 1");
	    		$selectLastID = mysql_fetch_array($selectLastID);
	    		
	    		$insertSQL = "INSERT IGNORE INTO related_search (id, searched_keyword) VALUES ($selectLastID[id]+1,'$keyword')";
	    		$result = mysql_query ($insertSQL); 
	    }
    }

    $updateSQL = "UPDATE related_search SET 
										related1='$keywordList[0]',
										related2='$keywordList[1]',
										related3='$keywordList[2]',
										related4='$keywordList[3]',
										related5='$keywordList[4]', 
										related6='$keywordList[5]' 
    				WHERE id ='$i'";

	$result = mysql_query ($updateSQL); 
    $i++;
}


$result = mysql_query("SELECT * FROM related_search ORDER BY id ASC");

echo "<table border='1'>
<tr>
<th>Searched Keyword</th>
<th>1</th>
<th>2</th>
<th>3</th>
<th>4</th>
<th>5</th>
<th>6</th>
</tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['searched_keyword'] . "</td>";
echo "<td>" . $row['related1'] . "</td>";
echo "<td>" . $row['related2'] . "</td>";
echo "<td>" . $row['related3'] . "</td>";
echo "<td>" . $row['related4'] . "</td>";
echo "<td>" . $row['related5'] . "</td>";
echo "<td>" . $row['related6'] . "</td>";
echo "</tr>";
}
echo "</table>";