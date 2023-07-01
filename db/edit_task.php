<?php
require 'conn.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $todoId = $_POST['id'];
    $judulAgenda = $_POST['title'];
    $isiKegiatan = $_POST['activity'];

    // Prepare and execute the SQL query
    $sql = "UPDATE activitas SET title = '$judulAgenda', activity = '$isiKegiatan' WHERE id = $todoId";

    if ($conn->query($sql) === TRUE) {
        // Database update successful
        $response = [
            'status' => 'success',
            'message' => 'Form submission successful'
        ];
        // Include any additional data you want to send back

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Database update failed
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
