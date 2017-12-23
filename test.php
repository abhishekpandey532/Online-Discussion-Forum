
<?php
session_start();

$x = array();
$pid=$_SESSION["postid"];
//$pid=38;

                include("config.php");
				$query  = "SELECT id, content FROM comments  where `postid`=$pid ORDER BY see ASC";
				$result = mysql_query($query);
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					
				$id  = stripslashes($row['id']);
				$text = stripslashes($row['content']);
				$x[$text] = $id."~".$id. $text;

					}

echo json_encode($x)
				?>