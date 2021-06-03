<!DOCTYPE html>
<html>
<body>

<?php
$host = "localhost";
$user = "root";
$pw = "";
$dbname = "atm_project";




global $conn;
//create connection
$conn = mysqli_connect($host, $user, $pw, $dbname);

//check connection
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

?>

</body>
</html>