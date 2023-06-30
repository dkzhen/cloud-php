<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $judulAgenda = $_POST['judul_agenda'];
    $isiKegiatan = $_POST['isi_kegiatan'];

    // Establish a database connection
    $servername = "192.3.108.23";
    $username = "root";
    $password = "Root123";
    $dbname = "todolist";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        $response = [
            'status' => 'error',
            'message' => 'Database connection failed: ' . $conn->connect_error
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Prepare and bind the SQL statement with parameters
    $stmt = $conn->prepare("INSERT INTO activitas (title, activity, isCompleted) VALUES (?, ?, 0)");
    $stmt->bind_param("ss", $judulAgenda, $isiKegiatan);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Database insertion successful
        $response = [
            'status' => 'success',
            'message' => 'Form submission successful'
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

    // Close the prepared statement and the database connection
    $stmt->close();
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
