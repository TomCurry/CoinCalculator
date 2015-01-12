<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
