<?php

$serverName = "db";
$dBUsername = "id20869490_root";
$dBPassword = "A1103316_a";
$dBName = "id20869490_kilk_database";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName, 3306);

if (!$conn)
{
    die("Connection failed: ". mysqli_connect_error());
}