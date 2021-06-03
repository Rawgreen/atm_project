<!DOCTYPE html>
<html>
<body>

<?php
require_once("config.php");

if(isset($_POST['login_submitted']))
{
    
    $manager_full_name = $_POST['manager_full_name'];
    $manager_pw = $_POST['manager_pw'];
    
    $exist = "SELECT * FROM manager WHERE manager_full_name = '$manager_full_name' AND manager_pw = '$manager_pw'";
    
    $result = $conn ->query($exist);

    if($result ->num_rows > 0)
    {
        header("refresh:0.3 url=manager_account_screen.php");
    }
    
    else
    {
        echo "<h1>Wrong ID or PASSWORD</h1>";
        echo "<br><br><br><br>";
        echo '<a href="manager_login_screen.php">
        <input type="button" value="Login Page" style="width: 200px; height:100px;">
    </a>';
    }

    
}
    else{
        echo '<form action = "manager_login_screen.php" method = "POST"/>';

        echo 'ID:<br> <input type = "text" name = "manager_full_name"> <br><br/>';

        echo 'Password:<br> <input type= "password" name = "manager_pw"/>';

        echo '<input type = "hidden" name = "login_submitted" value = "True"/>';

        echo '<br><br><br><input type = "submit" value= "ENTER"/>';
        echo '<br><br><input type= "button" value = "Cancel the process and back" onclick="history.back();"/>';
        echo '</form>'; 
    }
?>

</body>
</html>