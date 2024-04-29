<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "incgrade";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Failed to connect!");
}

// Fetch the maximum allowed value for the student_id column
$query = "SELECT MAX(CAST(student_id AS SIGNED)) AS max_student_id FROM students";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$max_student_id = $row['max_student_id'];

?>