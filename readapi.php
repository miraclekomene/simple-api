<?php 
// // datebase connection 
// $con = mysqli_connect("localhost", "root", "", "testapi");

// if(!$con){
//     echo "Database connection failed";
//     exit;
// }

// // =============== USERS ENDPOINT ======================
// $sql = "SELECT * FROM users";
// $results = mysqli_query($con, $sql);

// if (!$results) {
//     echo "Error retrieving data from database";
//     exit;
// }
// $response = array();
// while($row = mysqli_fetch_assoc($results)){
//     $response["data"][] = $row;
// }
// echo json_encode($response);


// // ================ STUDENT ENDPOINT ===================
// $stusql = "SELECT * FROM students";
// $sturesult = mysqli_query($con, $stusql);

// if(!$sturesult){
//     echo "Error fetching student data";
// }

// $sturesponse = array();
// while($strow = mysqli_fetch_assoc($sturesult)){
//     $sturesponse["students"][] = $strow;
// }
// echo json_encode($sturesponse);


// header("Content-Type:application/json");
// mysqli_close($con);
?>


<?php 

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "testapi");

// Check if connection was successful
if(!$con){
    echo json_encode(array("message" => "Database connection failed"));
    exit;
}

// USERS ENDPOINT
function getUsers($con){
    $sql = "SELECT * FROM users";
    $results = mysqli_query($con, $sql);

    if (!$results) {
        return array("message" => "Error retrieving data from database");
    }

    $response = array();
    while($row = mysqli_fetch_assoc($results)){
        $response[] = $row;
    }
    return $response;
}

// STUDENTS ENDPOINT
function getStudents($con){
    $stusql = "SELECT * FROM students";
    $sturesult = mysqli_query($con, $stusql);

    if(!$sturesult){
        return array("message" => "Error fetching student data");
    }

    $sturesponse = array();
    while($strow = mysqli_fetch_assoc($sturesult)){
        $sturesponse[] = $strow;
    }
    return $sturesponse;
}

// Call endpoint functions and encode response as JSON
header("Content-Type:application/json");
$response = array(
    "users" => getUsers($con),
    "students" => getStudents($con)
);
echo json_encode($response);

// Close database connection
mysqli_close($con);
?>