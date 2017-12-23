<?php
session_start();
//print_r($_SESSION);
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) {
   //echo 'Session is set';
   include('config.php');
$usrname=$_SESSION['name'];
//echo $_SESSION["name"];
     ?>


<?php
//session_start();
//print_r($_SESSION);
//if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) {
  // echo 'Session is set';
   //include('config.php');

     ?>



<html>
<head>

<title>HOME</title>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />

</head>
<body>


<div id="wrap">
<div id="header">

<h1><a href="#">HOME</a></h1>
</div>

<div id="menu">
<ul>
<li><a href="#">Home</a></li>
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
<?php
session_start();
//print_r($_SESSION);
//echo "<br/>"."Before if";

//if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
//{
  // echo "Session is set";

 ?>

<div id="content">
<div class="right"> 


<br /><br />

<?php
//$q1="SELECT `subject`,`content` FROM `post` WHERE `comments` >= 1 ORDER BY `comments' DESC";
$q1="SELECT `id`,`subject`, `content` FROM `post` ORDER BY `comments` DESC";

//$q1="SELECT `id`,`subject`, `content` FROM `post`";
$data=mysql_query($q1) or die(mysql_error());
//$row=mysql_fetch_array($data);
//echo $row[0];
$array=array();
while($row=mysql_fetch_array($data))
{
$q2="SELECT comments,added_by,time from post where id=$row[0] ";
$data2=mysql_query($q2) or die(mysql_error());
$row2=mysql_fetch_array($data2);


?>
<h1>
	<?php echo $row[1];
	$array[]=$row;

	 ?> </a></h1><br/>

No. of comments:<?php echo $row2[0]; ?><br/>
Added By:<?php 
$q3="SELECT `name` FROM `users` WHERE `id` = $row2[1]";
$data3=mysql_query($q3) or die(mysql_error());
$row3=mysql_fetch_array($data3);

echo $row3[0];

 ?><br/>
Added On:
<?php echo $row2[2]; ?><br/><br/>
<?php echo substr($row[2],0,300); ?><br/>
<a href="readmore.php?id=<?php echo $row[0]; ?>">Read More..</a><br/><br/>

<?php
}
?>
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
<li><a href="readmore.php?id=<?php echo $array[1]["id"]; ?>"><?php echo $array[1]["subject"]; ?></a></li> 
<li><a href="readmore.php?id=<?php echo $array[2]["id"]; ?>"><?php echo $array[2]["subject"]; ?></a></li> 
</ul>

</div>

<div style="clear: both;"> </div>

</div>

</div>

<div id="footer">
Copyright info
</div>
test
<?php print_r($_SESSION); ?>

<?php 
}

else {
?>
<script >
window.location="Login.php?error=please login first.";
</script>

<?php
}
?>

