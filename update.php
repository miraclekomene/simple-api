<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "testapi");

// Check if connection was successful
if(!$con){
    echo json_encode(array("message" => "Database connection failed"));
    exit;
}

// // UPDATE DATA => Handle the POST request
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Retrieve the JSON data from the request body
//     $json_data = json_decode(file_get_contents('php://input'));

//     if (isset($json_data->users) && is_array($json_data->users) && count($json_data->users) > 0) {
//         $user = $json_data->users[0]; // Assuming only one user is being updated

//         // Extract the values from the JSON data
//         $name = isset($user->name) ? mysqli_real_escape_string($con, $user->name) : '';
//         $email = isset($user->email) ? mysqli_real_escape_string($con, $user->email) : '';
//         $address = isset($user->address) ? mysqli_real_escape_string($con, $user->address) : '';

//         // Update the database
//         $sql = "UPDATE users SET name = '$name', email = '$email', address = '$address'";
//         $result = mysqli_query($con, $sql);

//         if ($result) {
//             echo json_encode(array("message" => "Data updated successfully"));
//         } else {
//             echo json_encode(array("message" => "Error updating data in the database"));
//         }
//     } else {
//         echo json_encode(array("message" => "Invalid data format or no user specified"));
//     }
// } else {
//     echo json_encode(array("message" => "Invalid request method"));
// }




// // UPDATE DATA => Handle the POST request
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $json_data = json_decode(file_get_contents('php://input'));

//     $id = mysqli_real_escape_string($con, $_GET['id']);
//     $email = mysqli_real_escape_string($con, $_GET['email']);

//     // Extract the values from the JSON data
//     $name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
//     $address = isset($_POST['address']) ? mysqli_real_escape_string($con, $_POST['address']) : '';

//     // Update the database
//     $sql = "UPDATE users SET name = '$name', address = '$address' WHERE id = '$id' AND email = '$email'";
//     $result = mysqli_query($con, $sql);

//     if ($result) {
//         echo json_encode(array("message" => "Data updated successfully"));
//     } else {
//         echo json_encode(array("message" => "Error updating data in the database"));
//     }
// } else {
//     echo json_encode(array("message" => "Invalid request method"));
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = json_decode(file_get_contents('php://input'));

    $id = mysqli_real_escape_string($con, $_GET['id']);
    $email = mysqli_real_escape_string($con, $_GET['email']);

    // Extract the values from the JSON data
    $name = isset($json_data->users[0]->name) ? mysqli_real_escape_string($con, $json_data->users[0]->name) : '';
    $address = isset($json_data->users[0]->address) ? mysqli_real_escape_string($con, $json_data->users[0]->address) : '';

    // Update the database
    $sql = "UPDATE users SET name = '$name', address = '$address' WHERE id = '$id' AND email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo json_encode(array("message" => "Data updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating data in the database"));
    }
} else {
    echo json_encode(array("message" => "Invalid request method"));
}


// Close database connection
mysqli_close($con);
?>
