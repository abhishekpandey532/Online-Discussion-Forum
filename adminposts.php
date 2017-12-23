<?php 
session_start();
print_r($_SESSION);
include('config.php');
$usrname=$_SESSION["name"];

?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />


</head>
<body>

<?php
session_start();
     
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
		<li><a href="adminhome.php">Home</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="adminposts.php">Posts</a></li>
		<li><a href="#">Links</a></li>
		<li><a href="#">Forum</a></li>
		<h3 style="color:blue;margin-right:1px;">

<li align="right"><a href="Logout.php">Logout</a></li>
</h3>
<h3 style="color:white;padding-left:57em">

<li style="margin-right:20px;"><?php echo "Hello&nbsp;&nbsp;".$usrname; ?></li>

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

<ul>
<li><a href="#">History</a></li> 
<li><a href="#">Science</a></li> 
<li><a href="#">Sports</a></li> 
</ul>

</div>

<div id="content">
	<div class="right">

	<form align="" class="form" method="post">
			<h1> All Posts</h1>

<table class="tg">
	<tr>
	<th class="tg-yw4l">User ID</th>
	<th class="tg-yw4l">&nbsp;&nbsp;&nbsp;&nbsp;Subject</th>
	<th class="tg-yw4l" >Content</th>&nbsp;&nbsp;
	<th class="tg-yw4l">Time(4th)</th>
	<th class="tg-yw4l">Comments</th>
	<th class="tg-yw4l">Options</th>
	</tr>

<?php
$id=$_SESSION["id"];
$q="SELECT * FROM `post`";
$data=mysql_query($q)or die(mysql_error());

while($row=mysql_fetch_array($data))
{
	$uid=$row["added_by"];
	$qu="SELECT * FROM users where id=$uid";
	$datau=mysql_query($qu)or die(mysql_error());
	$rowu=mysql_fetch_array($datau);
//print_r($row);
?>

	<tr>
		<td class="tg-yw4l"><?php echo $rowu[1]; ?></td>
		<td class="tg-yw4l">&nbsp;&nbsp;<?php echo $row[1]; ?></td>
		<td class="tg-yw4l"><?php echo substr($row[2],0,20) ?><a href="adminreadmore.php?id=<?php echo $row[0]; ?>" >Read More...</a></td>
		<td class="tg-yw4l"><?php echo $row[4]; ?></td>
		<?php
		$countcomment="SELECT count(*) as number FROM `comments` WHERE `postid` =  '$row[0]'";
		$data1=mysql_query($countcomment) or die(mysql_error());
		$r=mysql_fetch_array($data1);
		$row_counter = $r['number'];


		?>
		<td class="tg-yw4l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_counter; ?></td>
		<td class="tg-yw4l"><a href="editpost.php?id=<?php echo $row[0]; ?>"> Edit</a>
		<a href="deletepost.php?id=<?php echo $row[0]; ?>"> Delete</a></td>
	
	</tr>

<?php
}

?>
</table>
</div>
<!-- content closses -->

<div style="clear: both;"> </div>

<?php 
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

</body>
</html>