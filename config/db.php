<?php

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, "3306");

if(mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL ' + mysqli_connect_errno();
}