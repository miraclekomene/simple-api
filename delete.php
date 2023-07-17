<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "testapi");

// Check if connection was successful
if (!$con) {
    echo json_encode(array("message" => "Database connection failed"));
    exit;
}

// Handle the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the JSON data from the request body
    $json_data = json_decode(file_get_contents('php://input'));

    // // Extract the user ID from the JSON data
    // $user_id = mysqli_real_escape_string($con, $json_data->user_id);
    // Extract the user ID from the JSON data
    $user_id = mysqli_real_escape_string($con, $json_data->users[0]->user_id);


    // Delete the user data from the database
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo json_encode(array("message" => "User data deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting user data from the database"));
    }
} else {
    echo json_encode(array("message" => "Invalid request method"));
}

// Close database connection
mysqli_close($con);
?>
