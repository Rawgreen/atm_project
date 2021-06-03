<!DOCTYPE html>
<html>
<body>
<?php
require_once('config.php');

$acc = "SELECT * FROM accounts";

echo '<h2>Accounts</h2>';
// taking account information
if ($res = mysqli_query($conn, $acc))
{
    //if query worked properly
    if(mysqli_num_rows($res) > 0)
    {
        //making table
        echo '<table><tr><th>| Account id |</th>
        <th>| Account Name |</th><th>| Customer id |</th>';
        //taking info from database
        while ($row = mysqli_fetch_array($res))
        {
            echo "<tr><td> |".$row['account_id']."|</td><td>|".$row['account_name']."|</td><td>|".$row['customer_id']."|</td>";
        }
        echo '</table>';
        //in any problem
    }else{
        echo "<h1>Something happened <br></h1>";
        echo "<h3>Go back to main menu</h3>";
    }
}

echo "<br><br><br><br><br><br>";

echo '<h2>Transactions</h2>';
// taking transaction info


if($result = mysqli_query($conn, "SELECT * FROM transactions")){
    if(mysqli_num_rows($result) > 0){
        echo '<table><tr><th>| Transaction id |</th><th>| Transaction date |</th><th>| Transaction amount |</th>
        <th>| Account ID |</th><th>| ATM ID |</th><th>| Manager Name |</th>';

        while($col = mysqli_fetch_array($result)){
            echo "<tr><td> |".$col['transaction_id']."|</td><td>|".$col['transaction_date'].
            "|</td><td>|".$col['transaction_amount']."|</td><td> |".$col['account_id_fk']."|</td><td> |".$col['atm_id_fk'].
            "|</td></tr>";
        }
        echo '</table>';
    }else{
        echo "no transaction info available at the moment";
    }
}


echo '<br><br><br><br>';
echo '<h2>ATM Status </h2>';
// atm money balance

if (isset($_POST['submitted'])){
$add_money = $_POST['add_money'];
$upd_atm = "UPDATE atm_machine SET money_balance = money_balance + $add_money WHERE atm_id=1";

if($conn->query($upd_atm) === TRUE){
    echo 'updated atm';
}else{
    echo "Error: " . $upd_atm . "<br>" . $conn->error;
}

}
if($result = mysqli_query($conn, "SELECT * FROM atm_machine")){
    if(mysqli_num_rows($result) > 0){
        echo '<table><tr><th>| Atm ID |</th><th>| Money Balance |</th></tr>';
        while($col = mysqli_fetch_array($result)){
            echo "<tr><td> |".$col['atm_id']."|</td><td>|".$col['money_balance']."|</td></tr>";
            
        }
        echo'</table>';
    }else{
        echo'something went bad';
    }
}?>

<form action = "manager_account_screen.php" method = "post">
<br><br>
Add atm money:<br>
<input type = "text" name = "add_money"> <br><br/>
<input type = "hidden" name = "submitted" value = "1"/>
<input type = "submit" value= "ENTER" style="width: 75px; height:50px;"/>';
<br><br><br><br><br><br>
<input type= "button" value = "Back" style="width: 200px; height: 100px;" onclick="history.back(); "/>
<br><br>
<a href="index.php">
<input type="button" value="Exit from account" style="width: 200px; height:100px;">
</a>
</form>




</body>
</html>