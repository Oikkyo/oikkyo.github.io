
<?php

$username = $_POST['name'];
$userstorename = $_POST['storename'];
$userphone = $_POST['phone'];

$link = mysqli_connect('oikkyo-wishregdb-instance.ctncqewqxjhv.ap-south-1.rds.amazonaws.com', 'neelabjaroy95', 'Neelabjaroy21995','initial_oikkyowishreg_db');

$conn = new mysqli('oikkyo-wishregdb-instance.ctncqewqxjhv.ap-south-1.rds.amazonaws.com', 'neelabjaroy95', 'Neelabjaroy21995','initial_oikkyowishreg_db');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Check if server is alive
if (mysqli_ping($link))
  {
  echo "Connection is ok!";
  }
else
  {
  echo "Error: ". mysqli_error($link);
  }




 mysqli_query($link,"INSERT INTO table (`name`, `storename`, `phone`) VALUES ('$username', '$userstorename', '$userphone')") 
 or die(mysqli_error($link));


  echo "Entered data successfully\n";


mysqli_close($link);
?>






<!--?php
// Database connection settings
$servername = "your-rds-endpoint";
$username = "your-db-username";
$password = "your-db-password";
$dbname = "your-db-name";

// Create a connection to the AWS RDS database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Handle file upload
    $target_dir = "uploads/"; // Directory where uploaded files will be stored
    $target_file = $target_dir . basename($_FILES["photo"]["name"]); // Path to the uploaded file
    $uploadOk = 1; // Flag to check if the file was uploaded successfully

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if the file was uploaded successfully
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";

            // Insert data into the database
            $sql = "INSERT INTO form_responses (name, address, phone, photo_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $address, $phone, $target_file);

            if ($stmt->execute()) {
                echo "Data inserted successfully.";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$conn->close();
?>
