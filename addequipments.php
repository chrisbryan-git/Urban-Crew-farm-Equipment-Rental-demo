<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Equipment Form</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

form input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
}

form input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

form input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Disable styles for disabled fields */
form input:disabled {
    background-color: #f4f4f4;
    cursor: not-allowed;
}

.error-message {
    color: red;
    margin-top: 5px;
}


</style>
</head>
<body>

<h2>ADD EQUIPMENTS</h2>
<form action="" method="post" enctype="multipart/form-data">
  <label for="equipment_type">Equipment Type:</label>
  <select id="equipment_type" name="equipment_type" required>
    <option value="tractor">Tractor</option>
    <option value="harvester">Harvester</option>
    <option value="Transporters">Transporters</option>
    <option value="Loaders">Loaders</option>
    <option value="Headers">Headers</Header></option>
    <option value="Sprayers">Sprayers</option>
    <option value="Cultivators">Cultivators</option>
    <option value="Planters">Planters</option>
  </select><br><br>

  <label for="image">Upload Photo:</label>
  <input type="file" id="image" name="image" accept="image/*"><br><br>

  <label for="make">Make:</label>
  <input type="text" id="make" name="make" required><br><br>
  
  <label for="model">Model:</label>
  <input type="text" id="model" name="model" required><br><br>
  
  <label for="year_of_manufacture">Year of Manufacture:</label>
  <input type="number" id="year_of_manufacture" name="year_of_manufacture" min="1900" max="9999"><br><br>
  
  <label for="engine_size">Engine Size (Liters):</label>
  <input type="number" id="engine_size" name="engine_size" step="0.01" ><br><br> 
  
  <label for="horsepower">Horsepower:</label>
  <input type="number" id="horsepower" name="horsepower" min="1" ><br><br> 

  <label for="price">Price:</label>
  <input type="number" id="price" name="price" step="0.01" min="0" required><br><br>
  
  <label for="current_status">Current Status:</label>
  <select id="current_status" name="current_status" required>
    <option value="Available">Available</option>
    <option value="Rented">Rented</option>
    <option value="Under Maintenance">Under Maintenance</option>
  </select><br><br>
  
  <input type="submit" value="Submit">
</form>

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "urbancrew_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $equipment_type = mysqli_real_escape_string($conn, $_POST['equipment_type']);
    $make = mysqli_real_escape_string($conn, $_POST['make']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $year_of_manufacture = intval($_POST['year_of_manufacture']);
    $engine_size = floatval($_POST['engine_size']);
    $horsepower = intval($_POST['horsepower']);
    $price = floatval($_POST['price']);
    $current_status = mysqli_real_escape_string($conn, $_POST['current_status']);

    // Image handling
    if(isset($_FILES['image'])) {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); // Convert image to binary data
    } else {
        $image = null; // No image uploaded
    }

    // Insert data into the database
    $sql = "INSERT INTO equipment (equipment_type, make, model, year_of_manufacture, engine_size, horsepower, price, current_status, image)
            VALUES ('$equipment_type', '$make', '$model', $year_of_manufacture, $engine_size, $horsepower, $price, '$current_status', '$image')";

     if ($conn->query($sql) === TRUE) {
        $success_message = "New record created successfully";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>


</body>
</html>
