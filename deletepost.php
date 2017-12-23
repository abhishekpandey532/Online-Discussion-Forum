<html>
<body>
<?php
session_start();
include("config.php");
echo $id=$_GET["id"];
$q="DELETE FROM `post` WHERE `id` = $id";
mysql_query($q)or die(mysql_error());
$q1="DELETE FROM `comments` WHERE `postid` = $id";
mysql_query($q1)or die(mysql_error());

//"Deleted";
 //header('location:mypost.php');




?>

<?php
if($_SESSION["name"]=="admin")
{
?>
<script>
window.location="adminposts.php";
//alert("Deleted");
</script>

<?php
}
else {
?>
<script>
window.location="mypost.php";
//alert("Deleted");
</script>


<?php
}

?>
</body>
</html>