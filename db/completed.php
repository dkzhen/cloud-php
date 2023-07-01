<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the todo ID and isCompleted value from the AJAX request
    $todoId = $_POST['id'];
    $isCompleted = $_POST['isCompleted'];

    // Update the database with the new isCompleted value
    // Modify the query and database table according to your actual implementation

    $sql = "UPDATE activitas SET isCompleted=$isCompleted WHERE id=$todoId";

    if ($conn->query($sql) === TRUE) {
        // Database insertion successful
        $response = [
            'status' => 'success',
            'message' => 'Form submission successfull'
        ];
        // Include any additional data you want to send back

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Database insertion failed
        $response = [
            'status' => 'error',
            'message' => 'Error executing database query: ' . $conn->error
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request method
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
