<?php

$conn = require("../../database/connections/index.php");

try{
    $sql = "CREATE DATABASE pet_care";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
}catch(PDOException $e){
    echo $e->getMessage();
}