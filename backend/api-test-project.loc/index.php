<?php
// Include router class
include('Route.php');
header('Access-Control-Allow-Origin: *');
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
echo"200";
header('Access-Control-Allow-Origin: *');
}
// Add base route (startpage)
Route::add('/',function(){
header('Access-Control-Allow-Origin: *');
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "test-api";

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
     }
     $sql = "SELECT * FROM product";
     $result = $conn->query($sql);
     $myobj=[];
     if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
         array_push($myobj,$row);
       }
     } else {
       echo (null);
     }
     $myjson=json_encode($myobj);
     echo($myjson);
     $conn->close();

});


// Post route example
Route::add('/contact-form',function(){
    echo '<form method="post"><input type="text" name="id" placeholder="id" /><input type="text" name="name" placeholder="name"/><input type="text" name="price" placeholder="price" /><input type="submit" value="send" /></form>';
},'get');

// Post route example
Route::add('/contact-form',function(){
header('Access-Control-Allow-Origin: *');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test-api";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
     $price=(int)$_POST['price'];
     print_r($_POST);
    $sql = "INSERT INTO product (name, price)
    VALUES ('{$_POST['name']}', '{$price}')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
},'post');

Route::run('/');

?>
