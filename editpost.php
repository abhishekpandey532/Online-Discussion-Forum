
<?php
session_start();
     $usrname=$_SESSION['name'];
echo $_SESSION["name"];
     
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
{
   echo 'Session is set';

 ?>


<?php 
session_start();
print_r($_SESSION);
include('config.php');
//include('menubar.php');
?>


<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />

</head>
<body>
<script>
//window.location="mypost.php?";
</script>



<?php
?>
<div id="wrap">
<?php //include('menubar.php');
?>
<div id="header">

<h1><a href="#">HOME</a></h1>
</div>

<div id="menu">
<?php
if($usrname!="admin") {
	?>
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
<?php
}
else
{
?>
<ul>
<li><a href="adminhome.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="adminposts.php">Posts</a></li>
<li><a href="#">Links</a></li>
<li><a href="#">Forum</a></li>

<li align="right"><a href="Logout.php">Logout</a></li>
<h3 style="color:white;padding-left:57em">

<li style="margin-right:20px;"><?php echo "Hello&nbsp;&nbsp;".$usrname; ?></li>

</h3>
</h1>

</ul>
<?php
}
?>
</div>

<div id="content">
<div class="right"> 


<form class="form" method="post">

	<h1>Edit Post</h1>

	<?php 

	$pid=$_GET["id"];
	//echo  $pid;
	$q="SELECT `subject`, `content` FROM `post`";

//echo $i;
//echo $name;
//  mysql_query($q)or die(mysql_error());
//header("Location:mypost.php");
  $array=array();
$data=mysql_query($q)or die(mysql_error());
while($row=mysql_fetch_array($data))
	$array[]=$row;

$q="SELECT `subject`, `content` FROM `post` WHERE `id` = '$pid' ORDER BY `comments` DESC";
$data=mysql_query($q)or die(mysql_error());
$row=mysql_fetch_array($data);
$sub=$row[0];
$con=$row[1];

   ?>
<h2 align="left">Subject:<br/><textarea rows="2" name="subject" cols="70" id="subject"><?php  echo $sub; ?></textarea></h2>
<h2 align="left">Content:<br/>
<textarea rows="10" cols="70" fontsize="20px" name="content" id="content"><?php  echo $con; ?></textarea><br/><br/>
      <h2 align="center" ><button type="submit" value="submit" id="login-button" >Done</button> 
</h2>
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

?>
<ul>
<li><a href="readmore.php?id=<?php echo $array[0]["id"]; ?>" ><?php echo $array[0]["subject"]; ?></a></li> 
<li><a href="#"><?php echo $array[1]["subject"]; ?></a></li> 
<li><a href="#"><?php echo $array[2]["subject"]; ?></a></li> 
</ul>

</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	echo "In poSt";
$esub=$_POST["subject"];
$econ=$_POST["content"];
//echo $esub."<br/>";
//echo $econ."<br/>";

//echo "About to update";
$esub=addslashes($esub);
$econ=addslashes($econ);

$q="UPDATE `blog`.`post` SET `subject` = '$esub', `content` = '$econ' WHERE `post`.`id` = $pid";



 mysql_query($q)or die(mysql_error());
echo "Updated";
if($_SESSION["name"]=="admin")
{
?>
<script>
window.location="adminposts.php";
</script>
<?php
}
else
{
	?>
<script>
window.location="mypost.php";
</script>
	<?php
}
?>


<?php 
}
}

else

{

	?>

<script>
window.location="Login.php";
</script>

</form>
<?php
}

?>


<div style="clear: both;"> </div>




</body>
</html>
