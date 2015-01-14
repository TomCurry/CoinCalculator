<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coin Calculator</title>
    </head>
    <body>
        <h1>Coin Calculator</h1>
        <p></p>
        <form action="" method='post'>
            <input type='text' name='number'>
            <input type='submit' value="Calculate">
        </form>
    </body>
</html>
<?php
require "vendor/autoload.php";
$currency = new Coin\lib\Currencies\GBP;
$amount = new Coin\lib\Amount($currency);
if (isset($_POST['number'])) {
    $value = $_POST['number'];
    
    $validation = new Coin\lib\Validation($currency);
    $validation->numeric($value);
    $validation->isEmpty($value);
    $validation->nonNumericCharacter($value);
    
    if (!empty($validation->getErrors())){
        echo "<ul>";
            foreach ($validation->getErrors() as $error) {
                echo "<li>$error</li>";
            }
        echo "</ul>";
    } else {
        echo "You are converting $value";
        echo "<ul>";
        foreach ($amount->findCoinAmount($value) as $coins) {
            echo "<li>$coins</li>";
        }
        echo "</ul>";
    }
}
