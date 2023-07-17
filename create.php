<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "testapi");

// Check if connection was successful
if(!$con){
    echo json_encode(array("message" => "Database connection failed"));
    exit;
}
// INSERT DATA => Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the values from the data
    $name = mysqli_real_escape_string($con, $data['name']);
    $email = mysqli_real_escape_string($con, $data['email']);
    $address = mysqli_real_escape_string($con, $data['address']);

    // Insert the data into the database
    $sql = "INSERT INTO users (name, email, address) VALUES ('$name', '$email', '$address')";
    if (mysqli_query($con, $sql)) {
        echo json_encode(array("message" => "Data inserted successfully"));
    } else {
        echo json_encode(array("message" => "Error inserting data into the database"));
    }
} else {
    echo json_encode(array("message" => "Invalid request method"));
}
// Call endpoint functions and encode response as JSON
header("Content-Type:application/json");
// Close database connection
mysqli_close($con);
?>