<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coin Calculator</title>
        <link rel="stylesheet" type="text/css" href="assets/css/common.css">
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
        echo "<ul class='error'>";
            foreach ($validation->getErrors() as $error) {
                echo "<li>&#x2717; $error</li>";
            }
        echo "</ul>";
    } else {
        echo "<p>You are converting <b>$value</b></p>";
        echo "<ul class='coin'>";
        foreach ($amount->findCoinAmount($value) as $name => $coins) {
            echo "<li>$name x " .  count($coins) . "</li>";
        }
        echo "</ul>";
    }
}
