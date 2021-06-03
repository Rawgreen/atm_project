<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
require_once("config.php");
$array = $_SESSION["acc_id"];


if(isset($_POST['submitted'])){

    $trans_amount = $_POST['transaction_amount'];
    $deliv_id = $_POST['deliv_id'];


    $ins_wd = ("INSERT INTO transactions(transaction_id, transaction_date, transaction_type,transaction_amount, account_id_fk, atm_id_fk) VALUES ('', 'CURRENT_TIMESTAMP()', 'withdraw','$trans_amount', '$array[0]','1')");
    $upd_wd = "UPDATE accounts SET	account_balance = account_balance - $trans_amount WHERE account_id = $array[0]";
    
    
    $ins_dt = ("INSERT INTO transactions(transaction_id, transaction_date, transaction_type,transaction_amount, account_id_fk, atm_id_fk) VALUES ('', 'current_timestamp()', 'deposit','$trans_amount', '$deliv_id','1')");
    $upd_dt = "UPDATE accounts SET	account_balance = account_balance + $trans_amount WHERE account_id = $deliv_id ";
    



    if($conn->query($ins_wd) === TRUE){
        echo '';
    }else{
        echo "Error: " . $ins_wd . "<br>" . $conn->error;
    }

    if($conn->query($ins_dt) === TRUE){
        echo '';
    }else{
        echo "Error: " . $ins_dt . "<br>" . $conn->error;
    }
    

    if($conn->query($upd_dt) === TRUE){
        echo '';
    }else{
        echo "Error: " . $upd_dt . "<br>" . $conn->error;
    }    

    if($conn->query($upd_wd) === TRUE){
        echo '';
    }else{
        echo "Error: " . $upd_wd . "<br>" . $conn->error;
    }
}



echo "<form action = 'transfer.php' method = 'POST'/>";
echo '<br><br>';
echo 'Whom will the money be transferred to:<br><input type = "text" name = "deliv_id" <br><br/>';
echo '<br>';
echo 'Transfer amount:<br><input type = "text" name = "transaction_amount" <br><br/>';

echo '<input type = "hidden" name = "submitted" value = "True"/>';

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