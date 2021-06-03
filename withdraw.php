<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
require_once("config.php");

$array = $_SESSION["acc_id"];


if(isset($_POST['login_submitted']))
{
    
    $trans_amount = $_POST['transaction_amount'];

    $ins = ("INSERT INTO transactions(transaction_id, transaction_date, transaction_type,transaction_amount, account_id_fk, atm_id_fk) VALUES ('', 'CURRENT_TIMESTAMP', 'withdraw','$trans_amount', '$array[0]','1')");

    $upd_atm = "UPDATE atm_machine SET	money_balance= money_balance - $trans_amount WHERE atm_id=1";

	$upd_acc = "UPDATE accounts SET	account_balance = account_balance - $trans_amount WHERE account_id = $array[0]";
    

    if($conn->query($ins) === TRUE){
        echo '';
    }else{
        echo "Error: " . $ins . "<br>" . $conn->error;
    }


    if($conn->query($upd_atm) === TRUE){
        echo 'updated atm';
    }else{
        echo "Error: " . $upd_atm . "<br>" . $conn->error;
    }


    if($conn->query($upd_acc) === TRUE){
        echo 'updated account';
    }else{
        echo "Error: " . $upd_acc . "<br>" . $conn->error;
    }
} 
echo "<form action = 'withdraw.php' method = 'POST'/>";
echo '<br><br>';
echo 'Withdraw amount:<br> <input type = "text" name = "transaction_amount"> <br><br/>';


echo '<input type = "hidden" name = "login_submitted" value = "True"/>';

echo '<br><br><br><input type = "submit" value= "ENTER" style="width: 200px; height:100px;"/>';
echo '<br><br><input type= "button" value = "Back" style="width: 200px; height: 100px;" onclick="history.back(); "/>';


echo '<br><br><br>';
echo '<a href="index.php">
<input type="button" value="Exit from account" style="width: 200px; height:100px;">
</a>';
echo '</form>';
?>
</body>
</html>