<?php
session_start();
print_r($_SESSION);
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) {
   echo 'Session is set';
   include('config.php');
$usrname=$_SESSION['name'];
echo $_SESSION["name"];
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
<h1>About Forum</h1>
<br/><h4>
An Internet forum, or message board, is an online discussion site where people can hold conversations in the form of posted messages. They differ from chat rooms in that messages are often longer than one line of text, and are at least temporarily archived. Also, depending on the access level of a user or the forum set-up, a posted message might need to be approved by a moderator before it becomes visible.<br/><br/>
Forums have a specific set of jargon associated with them; e.g., a single conversation is called a "thread", or topic.
A discussion forum is hierarchical or tree-like in structure: a forum can contain a number of subforums, each of which may have several topics. Within a forum's topic, each new discussion started is called a thread, and can be replied to by as many people as so wish.
Depending on the forum's settings, users can be anonymous or have to register with the forum and then subsequently log in in order to post messages. On most forums, users do not have to log in to read existing messages.</h4>

</div>
<div class="left">
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

  <?php //echo substr($row[1],0,20);
  $array[]=$row;
?>
</a></h1>


<?php
}
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

