<?php

// Set API endpoint URL
$url = "http://localhost/api/readapi.php";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url); // Set URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as string
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set content type header

// Execute cURL session and store response
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)){
    echo 'Error: ' . curl_error($ch);
} else {
    // Print response
    echo $response;
    echo "<br/><br/><br/><br/><br/>";
    // Decode JSON response into PHP object
    $data = json_decode($response);
    // print_r() function or the var_dump()

    // Print users property of decoded object
    print_r($data->users);
    echo "<br/><br/><br/><br/><br/>"; 
    var_dump($data->users);
    
    echo "<div style='display: flex;'>"; 
    foreach($data->users as $p){
        echo '<div style="width: 200px; margin: 30px; box-shadow: 0px 5px 15px 5px black">
                    <h5 style="text-align: center; color: black;">' . $p->name ."</h5>
                    <h6 style='text-align: center; color: black;'><em> Email: " . $p->email . "</em><h6>
                    <h6 style='text-align: center; color: black;'>Address :".$p->address."</h6>
                </div>";
    }
    echo "<div/>";
}

// Close cURL session
curl_close($ch);
?>
