<?php 
session_start();
print_r($_SESSION);
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
     
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
{
   //echo 'Session is set';

 ?>





<script>
//window.location="mypost.php?";
</script>




<div id="wrap">
	<div id="header">
	<h1><a href="Home.php">HOME</a></h1>
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

<li style="margin-right:20px;"><?php 
$usrname=$_SESSION["name"];
echo "Hello&nbsp;&nbsp;".$usrname; ?></li>

</h3>
</h1>

</ul>
</div>



<div id="content">
<div class="left"> 
<?php 


//echo "Hello ";
$usrname=$_SESSION['name'];
//echo $_SESSION["name"];
//echo $usrname;

?>
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
	
	<div class="right">
		<?php
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 if ($_GET["success"]==1)
//echo "COmment Posted";
//echo $pageURL;
 ?>
<form align="" class="form" method="post" >

<!--	<h1 style:"margin-top:0px;">Post</h1> -->

	<br/>	
	<?php 

	$pid=$_GET["id"];
	//echo  $pid;
	$q="SELECT `subject`, `content`,`added_by`,`time` FROM `post` WHERE `id` = '$pid'";
//echo $i;
//echo $name;
//  mysql_query($q)or die(mysql_error());
//header("Location:mypost.php");
  
$data=mysql_query($q)or die(mysql_error());
 $row=mysql_fetch_array($data);
$sub=$row[0];
$con=$row[1];

   ?>

<?php



$q3="SELECT `name` FROM `users` WHERE `id` = $row[2]";
$data3=mysql_query($q3) or die(mysql_error());
$row3=mysql_fetch_array($data3);

?>
<!--
Added_By:<?php echo $row3[0]; ?><br/>
Added On:<?php echo $row[3]; ?><br/>
-->


<h1 align="left"><b>Subject:<br/><br/></b></h1><Label rows="2" name="subject" cols="100" id="subject" ><?php  echo $sub; ?></textarea><br/><br/></h2>
<h1 align="left"><b>Content:</br/></h1></b><br/>
<Label rows="20" cols="100" fontsize="20px" name="content" id="content" disabled> <?php  echo $con; ?></textarea><br/><br/>
      <h1 align="left"> Comments </h1><br/>
<?php
      $co="SELECT `user_id`, `date`, `content` FROM `comments` WHERE `postid` = $pid ORDER BY see ASC";

	   $data=mysql_query($co)or die(mysql_error());
		while($row=mysql_fetch_array($data))
		{
	   //$row=mysql_fetch_array($data)
?>
<Label>Comment:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row[2]."<br/>";?></Label>

<?php

}

?><br/>
<h3>Your Comment:<br/> <textarea name="comm" size="20"></textarea></h3>
<br/>
<button id="submit" name="submit">Post</button>
</div>




<div style="clear: both;"> </div>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//t=The User who makes the comment.
	$curruser=$_SESSION["id"];
$ycomment=$_POST["comm"];
$now=Date("Y-m-d h:i:s");


$up="INSERT INTO `blog`.`comments` (`id`, `user_id`, `date`, `content`, `postid`,`see`) 
VALUES (NULL, '$curruser', '$now', '$ycomment', '$pid',99)";
mysql_query($up) or die(mysql_error());
//Select the comments from post and update it to plus one.

$q3="SELECT comments from post where id='$pid' ";
$data=mysql_query($q3) or die(mysql_error());
$row=mysql_fetch_array($data);
$new=$row[0]+1;
$q4="UPDATE post SET comments=$new WHERE id=$pid";

 mysql_query($q4)or die(mysql_error());



?>
<script>
window.location="<?php echo $pageURL; ?>&success=1";
</script>








<?php
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$esub=$_POST["subject"];
$econ=$_POST["content"];
$q="UPDATE post SET subject='$esub',
content='$econ' WHERE id='$pid' ";

 mysql_query($q)or die(mysql_error());
echo "Updated";
*/
?>
<script>
//window.location="posts.php";
</script>
<?php
if ($_GET["success"]==1)
echo "COmment Posted";

$ycomment="";
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






</body>
</html>
