<?php 
session_start();
include('config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />


<title>Other Posts</title>
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
<h1><a href="#">HOME</a></h1>
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
		<h1>Others Posts</h1>
		<br/>
		<?php
		$id=$_SESSION["id"];
		$count="SELECT count(*) as number FROM `post` WHERE `added_by` !=  '$id'";
		$datap=mysql_query($count) or die(mysql_error());
		$rp=mysql_fetch_array($datap);
		$row_counter = $rp['number'];
		if($row_counter==0){


		?>
		
		<h1>Sorry No Posts to display.
				</h1>
		<?php
	}
		else {
			?>



		<form align="" class="form" method="post">
			
<table class="tg">
	<tr>
	<th class="tg-yw4l">User Name</th>
	<th class="tg-yw4l">Subject</th>
	<th class="tg-yw4l" >Content</th>
	<th class="tg-yw4l">Time(4th)</th>
	<th class="tg-yw4l">Comments</th>
	</tr>

<?php


//$countcomment="SELECT count(*) FROM `comments` WHERE `postid` = ";

$q="SELECT * FROM `post` WHERE `added_by` != '$id'";
$data=mysql_query($q)or die(mysql_error());


while($row=mysql_fetch_array($data))
{
	$r0=$row[0];
	$uid=$row["added_by"];
	$qu="SELECT * FROM users where id=$uid";
	$datau=mysql_query($qu)or die(mysql_error());
	$rowu=mysql_fetch_array($datau);
//print_r($row);
?>

	<tr>
		<td class="tg-yw4l" ><?php echo $rowu[1]; ?></td>
		<td class="tg-yw4l"><?php echo $row[1]; ?></td>
		<td class="tg-yw4l"><?php echo substr($row[2],0,20) ?><a href="readmore.php?id=<?php echo $row[0]; ?>" >Read More...</a></td>
		<td class="tg-yw4l"><?php echo $row[4]; ?></td>
		<?php
		$countcomment="SELECT count(*) as number FROM `comments` WHERE `postid` =  '$r0'";
		$data1=mysql_query($countcomment) or die(mysql_error());
		$r=mysql_fetch_array($data1);
		$row_counter = $r['number'];


		?>
		<td class="tg-yw4l">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_counter; ?></td>
		
		 		
	</tr>

<?php

}

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
</table>
</div>
</form>
<div style="clear: both;"> </div>
</div>

<div style="clear: both;"> </div>



</body>
</html>