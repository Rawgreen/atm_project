<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<!--Multi-Submit script -->
<script>
function SubmitForm()
{
     document.forms[''].action='account_screen.php';
     document.forms[''].submit();

     document.forms[''].action='login_screen.php';
     document.forms[''].submit();
     return true;
}
</script>
<form name="form" action="/atm_project/account_screen.php" method="post">
  <label for="cnum">Card Number:</label><br>
  <input type="text" id="cnum" name="card_number"><br>
  <label for="pw">Password:</label><br>
  <input type="text" id="pw" name="card_password"><br>
  <input type="submit" value="Submit">
</form>
<?php
require_once("config.php");


if(isset($_POST['login_submitted']))
{
    $card_num = $_POST['card_number'];
    $pw = $_POST['card_password'];
    
    $result = $conn->query("SELECT * FROM customers_cards WHERE card_number = '$card_num' AND card_password = '$pw'");

    if(mysqli_num_rows($result) > 0){
        echo '<h2>Welcome</h2>';
    }
    else
        {
            echo "<h1>Wrong ID or PASSWORD</h1>";
            echo "<br><br><br><br>";
            echo '<a href="login_screen.php">
            <input type="button" value="Login Page" style="width: 200px; height:100px;">
        </a>';
        }
}else
{
    echo "<form action = 'account_screen.php'/>";
    echo '<br><br><br>';
    echo '<a href="index.php">
    <input type="button" value="Exit to main menu" style="width: 200px; height:100px;">
    </a>';
    echo '</form>';
}

?>




</body>
</html>