<?php
const SERVER = "localhost";
const USER = "root";
const PASSWORD = "";
const BASE = "franklin";

try {
    $con = new PDO("mysql:host=".SERVER.";dbname=".BASE,USER,PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

} catch (Exception $e) {
    echo 'Error: '  . $e->getMessage();
}
