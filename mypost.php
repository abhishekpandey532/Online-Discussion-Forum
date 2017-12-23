<?php 
session_start();
include('config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />


</head>
<body>

<?php
session_start();
     $usrname=$_SESSION['name'];
echo $_SESSION["name"];
     
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
{
   echo 'Session is set';

 ?>



<div id="wrap">
	<div id="header">
<h1><a href="#">Home</a></h1>

</div>

<div id="menu">
	<ul>
		<li><a href="Home.php">Home</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="posts.php">Posts</a></li>
		<li><a href="#">Links</a></li>
		<li><a href="#">Forum</a></li>

<li align="right"><a href="Logout.php">Logout</a></li>
<h3 style="color:white;padding-left:57em">

<li style="margin-right:20px;"><?php echo "Hello&nbsp;&nbsp;".$usrname; ?></li>
</h3>

</h3>
</h1>
</ul>
</div>
<div class="left"> 

<h2>Categories :</h2>
<ul>
<li><a href="#">World Politics</a></li> 
<li><a href="#">Europe Sport</a></li> 
<li><a href="#">Networking</a></li> 
<li><a href="#">Nature - Africa</a></li>
<li><a href="#">SuperCool</a></li> 
<li><a href="#">Last Category</a></li>
</ul>
<h2>New Stories</h2>
<?php 


//echo "Hello ";
$usrname=$_SESSION['name'];
//echo $_SESSION["name"];
//echo $usrname;
$query="Select * from post ORDER BY `comments` DESC ";
$data=mysql_query($query);
$array=array();
while($row=mysql_fetch_array($data))
{
$array[]=$row;
}


?>
<ul>
<li><a href="readmore.php?id=<?php echo $array[0]["id"] ?>"><?php echo $array[0]["subject"]; ?></a></li> 
<li><a href="readmore.php?id=<?php echo $array[1]["id"] ?>"><?php echo $array[1]["subject"]; ?></a></li> 
<li><a href="readmore.php?id=<?php echo $array[2]["id"] ?>"><?php echo $array[2]["subject"]; ?></a></li> 
</ul>

</div>

<div id="content">
	<div class="right">
<?php
		$id=$_SESSION["id"];
		$count="SELECT count(*) as number FROM `post` WHERE `added_by` =  '$id'";
		$datap=mysql_query($count) or die(mysql_error());
		$rp=mysql_fetch_array($datap);
		$row_counter = $rp['number'];
		if($row_counter==0){


		?>
		<br/>
		<br/>
		<h1>Sorry No Posts to display.
				</h1>
		<?php
	}
		else {
			?>
	<form align="" class="form" method="post">
			<h1> Your Post</h1><br/>

<table class="tg">
	<tr>
	<th class="tg-yw4l">ID of the Post</th>
	<th class="tg-yw4l">&nbsp;&nbsp;Subject</th>
	<th class="tg-yw4l">&nbsp;&nbsp;Content</th>
	<th class="tg-yw4l">&nbsp;&nbsp;&nbsp;Time(4th)</th>
	<th class="tg-yw4l">Comments</th>
	<th class="tg-yw4l">Post Options</th>
	</tr>

<?php
//$id=$_SESSION["id"];
$q="SELECT * FROM `post` WHERE `added_by` = '$id'";
$data=mysql_query($q)or die(mysql_error());

while($row=mysql_fetch_array($data))
{
//print_r($row);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
?>

	<tr>
		<td class="tg-yw4l"><?php echo $row[0]; ?></td>
		<td class="tg-yw4l"><?php echo $row[1]; ?></td>
		<td class="tg-yw4l"><?php echo substr($row[2],0,20) ?><a href="readmore.php?id=<?php echo $row[0]; ?>" >Read More...</a></td>
		<td class="tg-yw4l"><?php echo $row[4]; ?></td>
		<?php
		$countcomment="SELECT count(*) as number FROM `comments` WHERE `postid` =  '$row[0]'";
		$data1=mysql_query($countcomment) or die(mysql_error());
		$r=mysql_fetch_array($data1);
		$row_counter = $r['number'];


		?>
		<td class="tg-yw4l">&nbsp;&nbsp;&nbsp;<?php echo $row_counter; ?></td>
		<td class="tg-yw4l"><a href="editpost.php?id=<?php echo $row[0]; ?>">Edit</a>
		<a href="deletepost.php?id=<?php echo $row[0]; ?>">Delete</td>
	</tr>

<?php
}

?>
</table>
</div>
<!-- content closses -->



<?php 
}
}
else
{
?>
<script>
window.location="Login.php";


</script>

<?php 
}

?>

</form>
<div style="clear: both;"> </div>
</div>
<div style="clear: both;"> </div>

</body>
</html>