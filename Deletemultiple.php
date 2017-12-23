<html>
<head>

<title>Delete Links.</title>

</head>

<body align="center">

<h2>Delete selected links.</h2>

<?php
include("config.php");
//$dbc = mysqli_connect('localhost','root','admin','sample')
//or die('Error connecting to MySQL server');

$query = "select id,subject,added_by,time from post";

$result = mysql_query($query) or die(mysql_error());

$count=mysql_num_rows($result);
?>
<form name="form1" method="post">

<table align="center" width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
	<table align="center" width="400" cellpadding="3" cellspacing="1" border="1px">

<td><tr>
<td colspan="3"><strong>Delete multiple posts</strong> </td>
</tr>
<tr>
<td>#</td>
<td ><strong>Subject</strong></td>
<td ><strong>Added By</strong></td>
<td ><strong>Time</strong></td>
</tr>

<?php

while ($row=mysql_fetch_array($result)) {
	//echo $row[0];
?>

<tr>
<td><input name="checkbox[]" type="checkbox" value="<?php echo $row[0]; ?>"></td>
<td ><?php echo $row[1]; ?></td>
<td ><?php echo $row[2]; ?></td>
<td><?php echo $row[3]; ?></td>
</tr>

<?php
}//while for the data ends.
?>

<tr>
<td colspan="4" align="center"><input name="delete" type="submit" value="Delete"></td>
</tr>



<?php

// Check if delete button active, start this 

if(isset($_POST['delete']))
{
    $checkbox = $_POST['checkbox'];

for($i=0;$i<count($checkbox);$i++){

echo $del_id = $checkbox[$i];
$sql = "DELETE FROM post WHERE id=$del_id";
mysql_query($sql);
}
// if successful redirect to delete_multiple.php 
if($result){
echo "Deleted";
}
 }

//mysqli_close($dbc);

?>

</table>
</form>
</td>
</tr>
</table>

</body>

</html>