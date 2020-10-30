<?php 
    $conn = new mysqli('localhost', 'root', 'root', 'onlinetest');
    if ($conn->connect_error) {
        die("connection failed " . $conn->connect_error);
    }
?>