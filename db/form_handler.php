<?php
require 'conn.php';
// Check if the request method is POST
if (isset($_POST['judul_agenda'])) {
    // Retrieve the form data
    $judulAgenda = $_POST['judul_agenda'];
    $isiKegiatan = $_POST['isi_kegiatan'];


    // Prepare and execute the SQL query
    $sql = "INSERT INTO activitas (`title`,`activity`,`isCompleted`) VALUES ('$judulAgenda', '$isiKegiatan',0);";
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
