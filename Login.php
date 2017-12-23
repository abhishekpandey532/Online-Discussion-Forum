
<?php
session_start();

//echo "Destryyyyed";
echo $_SESSION["name"];
?>

<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" href="csslink/stylelogin.css">
</head>
<body> 
  
<?php
//session_destroy();
// define variables and set to empty values
//session_destroy();
print_r($_SESSION);
$nameErr ="";
$name = $pswd= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   

$pswd=$_POST["password"];

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

 <div class="wrapper">
	<div class="container">
		
<h1 align="center">LOG IN
<?php
// define variables and set to empty values

//echo "Hell";
//print_r($_SESSION);
//if(!isset($_SESSION["name"]))
  //echo "";
//else
  //echo "";

//print_r($_SESSION);
?></h2>
<h3 align="center">
<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

   Name: <input type="text" placeholder="Username" name="name" value="<?php echo $name;?>">
   <br>
Password: <input type="password" placeholder="password" name="password" value="<?php echo $pswd;?>" ><br/>
   <button type="submit" value="submit" id="login-button">Login</button> <br/><br/>
  <a href="Signup.php">Sign Up </a> <br/><br/>
<script >
function redirect(){
window.location="Signup.php";
}
</script>
  
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
if(!empty($_POST["name"]) && !empty($_POST["password"]))
{
$row_counter = 0;
include('config.php');
//Procedutre to fetch the data.
$chk = "Select count(*) as number from users where name='$name' AND password='$pswd' ";
echo 'hello';
$data = mysql_query($chk)or die(mysql_error());
$row = mysql_fetch_array($data);
$row_counter = $row['number'];

//validate if a user exists or not.
//Check this condition to see if there are already rows existing
if($row_counter == 0)
{
echo "There is no Such user! PLease Sign Up";
?>
<script type="text/javascript">
alert("Wrong UserId or Password");
</script>
<?php 
}

else
{
  echo "IN else";
//Login page code
session_start();
$nm="SELECT `name`,`id`  FROM `users` WHERE `password` = '$pswd'";
$data=mysql_query($nm)or die(mysql_error());
$row=mysql_fetch_array($data);
$_SESSION["name"]=$row[0];
$_SESSION["id"]=$row[1];
//$_SESSION["count"]=1;
//echo $row[0];
print_r($_SESSION);
if($_SESSION["name"]!="admin")
{
?>
<script>
window.location="Home.php";
</script>
<?php
}
else
{
  ?>
<script>
window.location="adminHome.php";
</script>


  <?php
}
}
}
}

 ?>
 


</body>
</html>