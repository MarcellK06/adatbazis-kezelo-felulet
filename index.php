<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hidden {
            border:none;
            color:transparent;
        }
    </style>
</head>
<body>
    
<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'adatok_1';

$conn = new mysqli($host, $username, $password, $database);

$tables = $conn->query("SHOW TABLES");

if ($tables->num_rows > 0) {
    while($table = $tables->fetch_assoc())
    {
        echo "<table class='table text-center'>";
        $tablename = $table["Tables_in_$database"];
        $tablecolumns = $conn->query("SELECT COLUMN_NAME AS 'name' FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename'");
        $cols = [];
        echo "<thead><tr>";
            if($tablecolumns->num_rows > 0)
            while($tablecolumn = $tablecolumns->fetch_assoc()) {
        $tablecolumname = $tablecolumn['name'];
                echo "<th scope='col'>$tablecolumname</th>";
                $cols[] = $tablecolumname;
            }
            echo "<td></td><td></td>";
        echo "</tr></thead>";
        echo "<tbody>";
        $tabledata = $conn->query("SELECT * FROM $tablename");
        if ($tabledata->num_rows > 0) {
            while($tablerow = $tabledata->fetch_assoc()) {
                echo "<tr>";
                echo "<form method='post' action='/update.php'>";
                foreach($cols as $column)
                    echo "<td><input type='text' id='".$column."' name = '".$column."' class='form-control' value='".$tablerow[$column]."'></td>";
                    echo "<td><input type='checkbox' id='del' name='del' value='del'/><label for='del'>Törlés</label></td>";
                echo "<td><input type='submit' value='Módosítás'  class='form-control btn btn-primary'/></td>";
                echo "<td><input type='text' id='tablename' name='tablename' class='hidden' value='".$tablename."'/></td>";
                echo "</form>";
                echo "</tr>";
            }
        }
        echo "<form method='post' action='/upload.php'>";
        echo "<tr>";
        foreach($cols as $column)
        echo "<td><input type='text' required name='".$column."' class='form-control' id='".$column."'/></td>";
    echo "<td></td><td><input type='submit' value='Hozzáadás'  class='form-control btn btn-primary'/></td>";
    echo "<td><input type='text' id='tablename' name='tablename' class='hidden' value='".$tablename."'/></td>";
    echo "</tr>";
    echo "</form>";
        echo "</tbody>";
        echo "</table>";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
