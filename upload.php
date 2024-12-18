<?php

if(!$_POST['tablename'])
return;

session_start();

$table = $_POST['tablename'];
$q = "INSERT INTO $table VALUES(";
foreach($_POST as $cols)
{
    if ($cols != $table)
    $q = $q."'".$cols."'".",";
}
$q = substr($q, 0, -1);

$q = $q.");";


$host = $_SESSION['host'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$database = $_SESSION['database'];

$conn = new mysqli($host, $username, $password, $database);

if ($conn->query($q))
    echo "SIKER";
else
    echo "HIBA!";

header("location:javascript://history.go(-1)");
