<?php
require 'conn.php';
// Fetch data from the "todos" table
$sql = "SELECT * FROM activitas";
$result = $conn->query($sql);

//fetch total data
$sqlNum = "SELECT COUNT(*) as total_rows FROM activitas";
$sqlCompleted = "SELECT COUNT(*) FROM activitas";

$total = $conn->query($sqlNum);

$totalRows;
if ($total && $total->num_rows > 0) {
    $row = $total->fetch_assoc();
    $totalRows = $row['total_rows'];
}

//fetch isCompleted 
// Query to get the count of rows where isCompleted = 1
$sql_completed = "SELECT COUNT(*) as total_completed FROM activitas WHERE isCompleted = 1";

$result_completed = $conn->query($sql_completed);

// Query to get the count of rows where isCompleted = 0
$sql_not_completed = "SELECT COUNT(*) as total_not_completed FROM activitas WHERE isCompleted = 0";

$result_not_completed = $conn->query($sql_not_completed);

if ($result_completed && $result_completed->num_rows > 0 && $result_not_completed && $result_not_completed->num_rows > 0) {
    $row_completed = $result_completed->fetch_assoc();
    $totalCompleted = $row_completed['total_completed'];

    $row_not_completed = $result_not_completed->fetch_assoc();
    $totalNotCompleted = $row_not_completed['total_not_completed'];
}
if ($totalCompleted == 0) {
    $persenTotal = 0;
} else {
    $persenTotal = ($totalCompleted) / $totalRows * 100;
}


$formattedPercentage = number_format($persenTotal, 2);
if ($totalRows == 0) {
    $formattedPercentage = 0;
} elseif ($totalNotCompleted == 0) {
    $formattedPercentage = 100;
}
// Store the fetched data in an array
$todoList = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $todoList[] = $row;
    }
}
