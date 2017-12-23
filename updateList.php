<?php 
include("config.php");
$array	= $_POST['arrayorder'];
print_r($array);

if ($_POST['update'] == "update"){
 $array[0];
$cid=$array[0];


$q1="Select see,content from comments where see=$cid";
$data=mysql_query($q1) or die(mysql_error());
$row=mysql_fetch_array($data);

//if($row[0]==1 && $row[1]!='Abhishek'){

//echo "You are teaching in that slot in some other class.";
//	echo "jQuery("div1-response").replaceWith(reloaded)";
//	echo	"sortable()";
//}

//else{
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE comments SET see = " . $count . " WHERE id = " . $idval;
		mysql_query($query) or die('Error, insert query failed');
		$count ++;	
//	}
	echo 'All saved! refresh the page to see the changes';
}
}
?>