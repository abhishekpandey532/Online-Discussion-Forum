



<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />

</head>
<body>
<?php
session_start();
     $usrname=$_SESSION['name'];
//echo $_SESSION["name"];
     
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
{
   echo 'Session is set';

 ?>


<div id="wrap">
	<div id="header">


		
<?php 
//print_r($_SESSION);
include('config.php');
//session_start();

//session_start();
//print_r($_SESSION);

?>

<h1><a href="home.php">HOME</a></h1>
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
</h1>

</ul>
</div>

<div id="content">
<div class="right"> 

      
<form align="" class="form" method="post">
	<br/>

	<h1>Add New Post </h1><br/>
	<h3><a href="mypost.php">Your Posts</a></h2>
	<h3><a href="otherpost.php">Other Posts</a></h3>
<h2 align="left">Subject:<br/><br/><textarea rows="2" name="subject" cols="70" id="subject"></textarea></h2>
<h2 align="left">Content:<br/><br/>
<textarea rows="20" cols="70" fontsize="20px" name="content" id="content"></textarea><br/><br/>
      <h2 align="center"  ><button type="submit" value="submit" id="login-button" >Post</button> 
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
$query="Select * from post ORDER BY `comments` DESC";
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
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$s=$_POST["subject"];
$c=$_POST["content"];
$name=$_SESSION["name"];
$i=$_SESSION["id"];
$now=Date("Y-m-d h:i:s");
//echo $i;
//echo $name;
$q="INSERT INTO `blog`.`post` (`id`, `subject`, `content`, `added_by`, `time`, `comments`) VALUES (NULL, '$s', '$c', '$i', '$now', '0');";
mysql_query($q)or die(mysql_error());
//header("Location:mypost.php");
?>

<script>
window.location="mypost.php";
</script>

<?php
}

}//session st if

else
{
	echo "Where is it?";

?>

<script type="text/javascript">
window.location="Login.php";
</script>
	
	<?php
	echo "Reachd End";
}
//echo $s;

?>





<div style="clear: both;"> </div>

</form>


</body>
</html>
