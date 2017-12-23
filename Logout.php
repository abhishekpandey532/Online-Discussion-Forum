<html>
<head>
</head>
<body>

	
<?php
print_r($_SESSION);
session_start();
session_unset();
session_destroy();

print_r($_SESSION);
?>

<script>
window.location="Login.php";
</script>


</body>
</html>