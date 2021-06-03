<!DOCTYPE html>
<html>
<body>
<?php
require_once("config.php"); 
echo "<br><br><br>Project-17: Bankamatik Yönetim Yazılımı<br><br><br>";
echo "------------------------------------------------------------<br><br>";

echo "Please click 'Customer Login' to directed to the login screen <br><br><br><br>";

mysqli_close($conn);
?>
<a href="login_screen.php">
<input type="submit" value="Customer Login"/>
</a>
<a href="manager_login_screen.php" style="padding-left: 30px;">
    <input type="button" value="Manager Login">
</a>

</body>
</html>