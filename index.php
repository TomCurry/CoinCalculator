<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coin Calculator</title>
        <link rel="stylesheet" type="text/css" href="assets/css/common.css">
    </head>
    <body>
        <h1>Coin Calculator</h1>
        <p>Please enter an amount of money. e.g. £1.54, 59p</p>
        <form action="" method='post'>
            <input type='text' name='number' maxlength="10">
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
    $input = $validation->cleanData($value);
    $validation->numeric($input);
    $validation->isEmpty($input);
    $validation->nonNumericCharacter($input);
    //$validation->inputMaxLength($input);
    
    if (!empty($validation->getErrors())){
        echo "<ul class='error'>";
            foreach ($validation->getErrors() as $error) {
                echo "<li>&#x2717; $error</li>";
            }
        echo "</ul>";
    } else {
        echo "<p>You are converting <b>$input</b></p>";
        echo "<ul class='coin'>";
        foreach ($amount->findCoinAmount($input) as $name => $coins) {
            echo "<li>$name x " .  count($coins) . "</li>";
        }
        echo "</ul>";
    }
}
