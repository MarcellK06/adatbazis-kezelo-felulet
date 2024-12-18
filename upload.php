<?php

if(!$_POST['tablename'])
return;

$table = $_POST['tablename'];
$q = "INSERT INTO $table VALUES(";
foreach($_POST as $cols)
{
    if ($cols != $table)
    $q = $q."'".$cols."'".",";
}
$q = substr($q, 0, -1);

$q = $q.");";


$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'adatok_1';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->query($q))
    echo "SIKER";
else
    echo "HIBA!";

header("location:javascript://history.go(-1)");
