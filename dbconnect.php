<?php

// $conn = mysqli_connect("localhost","mindloops_admin","jhy&(spBSsqt","mindloops_db");

$conn = mysqli_connect('localhost', 'root', '', 'db_mindloop');

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
    exit();
}
