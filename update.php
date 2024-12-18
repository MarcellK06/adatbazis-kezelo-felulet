<?php

if (!$_POST['tablename'])
return;

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
