<?php 
session_start();
print_r($_SESSION);
include('config.php');
?>


<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" type="text/css" href="csblog/style.css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){ 	

	  function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });
    
}, 10000);}
	
    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			var x = $(this).sortable("serialize");
			//alert(x);
			var order = $(this).sortable("serialize") + '&update=update'; 
			$.post("updateList.php", order, function(theResponse){
				$("#response").html(theResponse);

				//alert(theResponse);	

				if(theResponse != "All saved! refresh the page to see the changes")
				{
				//	alert("IN response");
				//alert('asda');
				$.getJSON( "test.php", function( data ) {
$("#list ul li").remove();
$.each(data, function(  ){
          var arr = this.split('~');
         // alert(arr[0]);
          //alert(arr[1]);
          var x = '<li id="arrayorder_'+arr[0]+'">'+arr[1]+'</li>';
$("#list ul").append(x);
	

        });
});



					//var url = 'index.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                      // $('#div1-response').live(url + ' #div1'); //note: the space before #div1 is very important
					//sortable();
					//ready();

				}
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script>
</head>
<body><?php
session_start();
     
if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
{
   echo 'Session is set';

 ?>





<script>
//window.location="mypost.php?";
</script>




<div id="wrap">
	<div id="header">
	<h1><a href="adminhome.php">HOME</a></h1>
</div>
<div id="menu">
<ul>
	<?php 
	if($_SESSION["name"]=="admin"){
	?>
<li><a href="adminhome.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="adminposts.php">Posts</a></li>
<li><a href="#">Links</a></li>
<li><a href="#">Forum</a></li>
<h3 style="color:blue;margin-right:1px;">

<li align="right"><a href="Logout.php">Logout</a></li>
</h3>
</h1>

</ul>
</div>

<?php
}
else
{
?>
<li><a href="Home.php">Home</a></li>
<li><a href="#">About</a></li>
<li><a href="mypost.php">Posts</a></li>
<li><a href="#">Links</a></li>
<li><a href="#">Forum</a></li>
<h3 style="color:blue;margin-right:1px;">

<li align="right"><a href="Logout.php">Logout</a></li>
</h3>
</h1>

</ul>
</div>


<?php
}
?>

<h2>New Stories</h2>

<div id="content">
<div class="left"> 
<?php 


echo "Hello ";
$usrname=$_SESSION['name'];
echo $_SESSION["name"];
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
<ul>
<li><a href="#">History</a></li> 
<li><a href="#">Science</a></li> 
<li><a href="#">Sports</a></li> 

</ul>

</div>
	
	<div class="right">
		

<!--	<h1 style:"margin-top:0px;">Post</h1> -->

	<br/>	
	<?php 

	$pid=$_GET["id"];
	$_SESSION["postid"]=$pid;
	print_r($_SESSION);
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

Added_By:<?php echo $row3[0]; ?><br/>
Added On:<?php echo $row[3]; ?><br/>

<!--
This is for subject and the content of the post.
	!-->

<h1 align="left"><b>Subject:<br/><br/></b></h1><Label rows="2" name="subject" cols="100" id="subject" ><?php  echo $sub; ?></textarea><br/><br/></h2>
<h1 align="left"><b>Content:</br/></h1></b><br/>
<Label rows="20" cols="100" fontsize="20px" name="content" id="content" disabled> <?php  echo $con; ?></textarea><br/><br/>


	<!--
This part is used for display the comments.
-->
      <h1 align="left"> Comments </h1>
      <div id="list">
      	<h2>Drag and Drop Comments to rearrange</h2><br/>
    <div id="div1-response">
    	<div id="div1">
    		<ul>
<?php
      $co="SELECT `user_id`, `date`, `content`,`id` FROM `comments` WHERE `postid` = $pid ORDER BY see ASC";

	   $data=mysql_query($co)or die(mysql_error());
		while($row=mysql_fetch_array($data))
		{
	   //$row=mysql_fetch_array($data)
			$count++;
				$id = stripslashes($row['id']);
				$text = stripslashes($row['content']);
?>

      <li id="arrayorder_<?php echo $id ?>"><?php echo $id?> <?php echo $text; ?>
</li>

<?php

}

?>
</ul>
</div>

</div>
</div>
</div>


<div style="clear: both;"> </div>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//t=The User who makes the comment.
	$curruser=$_SESSION["id"];
$ycomment=$_POST["comm"];
$now=Date("Y-m-d h:i:s");


$up="INSERT INTO `blog`.`comments` (`id`, `user_id`, `date`, `content`, `postid`) 
VALUES (NULL, '$curruser', '$now', '$ycomment', '$pid')";
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
