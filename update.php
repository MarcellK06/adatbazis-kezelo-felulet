<?php

if (!$_POST['tablename'])
return;
session_start();

$tablename = $_POST['tablename'];
$q = "";
if ($_POST['del'])
{
    $q = "DELETE FROM $tablename WHERE id=".$_POST['id'];
}
else {
$q = "UPDATE $tablename SET ";
foreach($_POST as $colname=>$col)
    if($col != $tablename && $col != "id")
        $q = $q.$colname."='".$col."', ";

$q = substr($q, 0, -2);

$q = $q." WHERE id=".$_POST['id'];
}


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
