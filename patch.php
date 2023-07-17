<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "testapi");

// Check if connection was successful
if(!$con){
    echo json_encode(array("message" => "Database connection failed"));
    exit;
}
// Assuming the necessary server and database connection setup is done before this code

// Check if it's a PATCH request
// if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
//     // Get the name parameter from the URL
//     // $name = isset($_GET['name']) ? $_GET['name'] : '';
//     $email = isset($_GET['email']) ? $_GET['email'] : '';

//     // Retrieve the JSON data from the request body
//     $json_data = json_decode(file_get_contents('php://input'));

//     // Extract the values from the JSON data
//     $content = isset($json_data->content) ? mysqli_real_escape_string($con, $json_data->content) : '';
//     $created_at = isset($json_data->created_at) ? mysqli_real_escape_string($con, $json_data->created_at) : '';
//     $modified_by = isset($json_data->modified_by) ? mysqli_real_escape_string($con, $json_data->modified_by) : '';

//     // Perform the update
//     $sql = "UPDATE users SET name = '$content', email = '$created_at', address = '$modified_by' WHERE email = '$email'";
//     $result = mysqli_query($con, $sql);

//     if ($result) {
//         echo json_encode(array("message" => "Author information updated successfully"));
//     } else {
//         echo json_encode(array("message" => "Error updating author information"));
//     }
// } else {
//     echo json_encode(array("message" => "Invalid request method"));
// }

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    // Get the id and email parameters from the URL
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';

    // Retrieve the JSON data from the request body
    $json_data = json_decode(file_get_contents('php://input'));

    if (isset($json_data->users) && is_array($json_data->users) && count($json_data->users) > 0) {
        $user = $json_data->users[0]; // Assuming only one user is being updated

        // Extract the values from the JSON data
        $name = isset($user->name) ? mysqli_real_escape_string($con, $user->name) : '';
        $email = isset($user->email) ? mysqli_real_escape_string($con, $user->email) : $email; // Use the existing email from the URL
        $address = isset($user->address) ? mysqli_real_escape_string($con, $user->address) : '';

        // Update the database
        $sql = "UPDATE users SET name = '$name', address = '$address' WHERE id = '$id' AND email = '$email'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo json_encode(array("message" => "User information updated successfully"));
        } else {
            echo json_encode(array("message" => "Error updating user information"));
        }
    } else {
        echo json_encode(array("message" => "Invalid data format or no user specified"));
    }
} else {
    echo json_encode(array("message" => "Invalid request method"));
}



// Close the database connection
mysqli_close($con);

?>