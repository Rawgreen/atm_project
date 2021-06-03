<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php
require_once("config.php");

$acc_id;

//pull login info from login_screen.php page
$cust_card_info = $_POST['card_number'];
$cust_pw_info = $_POST['card_password'];


// ACCOUNT INFORMATION
$id ="SELECT account_id,account_name,account_balance FROM accounts WHERE account_id =(SELECT account_id FROM customers_cards WHERE card_number = '$cust_card_info')";

$res = mysqli_query($conn, $id);
if($res){
    if(mysqli_num_rows($res) > 0){
        $col = mysqli_fetch_array($res);

        $acc_id[] = $col[0];
        $_SESSION["acc_id"] = $acc_id;
    }
}

if($result = mysqli_query($conn,$id))
{

    if(mysqli_num_rows($result) > 0)
    {
        //making table
    echo '<table><tr><th>| Account ID |</th><th>| Account Name |</th><th>| Account Balance |</th>';

    //taking info from database
    while ($row = mysqli_fetch_array($result))
    {
        echo "<tr><td> | ".$row['account_id']." |</td><td> | ".$row['account_name']." |</td><td> |".$row['account_balance']." |</td></tr>";
    }
    
    echo '</table>';
    //in any problem
    }else{
        echo "<h1>Something happened <br></h1>";
        echo "<h3>Go back to main menu</h3>";
    }
}




echo '<br><br><br><br><br>';
// CARD INFORMATION
$card = "SELECT card_number, date_valid_from, date_valid_to FROM customers_cards WHERE card_password = '$cust_pw_info'";

//pulling data from db
if($result = mysqli_query($conn,$card))
{   
    //checking if values are came
    if(mysqli_num_rows($result) > 0)
    {
        //making table
        echo '<table><tr><th>| Card Number |</th><th>| Card Production Date |</th><th>| Card Expiration Date |</th>';

        //process info
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr><td> |".$row['card_number']."|</td><td> |".$row['date_valid_from']." |</td><td> | ".$row['date_valid_to']." |</td></tr>";
        }
        echo '</table/>';
     //in any problem   
    }else{
        echo "<h1>Something happened <br></h1>";
        echo "<h3>Go back to main menu</h3>";
    }
}








echo '<br><br><br><br><br>';
//PRIVATE INFORMATION
$priv_info = "SELECT customer_first_name, customer_last_name, customer_phone, customer_email, customer_address FROM customers WHERE customer_id = 
(SELECT customer_id FROM accounts WHERE account_id = (SELECT account_id FROM customers_cards WHERE card_number = '$cust_card_info'))";

// pull data from db
if($result = mysqli_query($conn, $priv_info))
{
    //check
    if(mysqli_num_rows($result) > 0)
    {
        //create table
        echo '<table><tr><th>| First Name |</th><th>| Last Name |</th><th>| Phone Number |</th><th>| Email |</th><th>| Address |</th>';

        //process info
        while($col = mysqli_fetch_array($result))
        {
            echo "<tr><td> |".$col['customer_first_name']."|</td><td> |".$col['customer_last_name']." |</td><td> | ".$col['customer_phone']." |</td><td> |"
            .$col['customer_email']." |</td><td> |".$col['customer_address']." |</td></tr>";
        }
        echo '</table/>';
        //
    }else
    {
        echo "<h1>Something happened <br></h1>";
        echo "<h3>Go back to main menu</h3>";
    }
}
?>


<br><br><br><br><br>

<a href="customer_transaction.php">
    <input type="button" value="Transactions" style="width: 200px; height:100px;">
    </a>




<br><br><br><br><br>
<!-- exit button -->
    <a href="index.php">
    <input type="button" value="Exit from account" style="width: 200px; height:100px;">
    </a>

</body>
</html>