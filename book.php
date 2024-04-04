<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

     <style>
          section{
    padding: 4rem 0 2rem;
  } 
  .logo {
    font-size: 2rem;
    font-weight: 900;
    color: rgb(4, 8, 46);
}

.logo span {
    color: rgb(14, 192, 7);
}
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
        }
        #menu-icon {
      font-size: 24px;
      cursor: pointer;
      color: rgb(235, 119, 90);
      display: none;
  }

        h2 {
            text-align: center;
            color: #333;
        }

        h3 {
            margin-top: 20px;
            color: #555;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="time"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="time"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #007bff;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Form sections */
        .personal-info,
        .booked-details,
        .appointment-section,
        .total-charges {
            margin-bottom: 20px;
        }

        /* PHP output */
        .booked-details img {
            max-width: 100%;
            margin-top: 10px;
        }

        .appointment-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.appointment-section label {
    display: block;
    margin-bottom: 5px;
    color: #666;
}

.appointment-section input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.appointment-section input[type="date"]:focus {
    outline: none;
    border-color: #007bff;
}

.appointment-section input[type="date"]::-webkit-calendar-picker-indicator {
    color: transparent;
    background: transparent;
}

        .footer{
    background-color: rgb(56, 55, 55);
    color: rgb(211, 211, 214);
    border-top: 2px solid rgb(77, 74, 74);
}
.footer-container{
    display: flex;
    justify-content: space-between;
    gap: 1rem;
     margin: 30px;
}
.footer-container .logo{
    color: rgb(4, 8, 46);
    margin-bottom: 1rem;
}
.footer-container .footer-box{
    display: flex;
    flex-direction: column;
}
.social{
    display: flex;
    align-items: center;
   
}
.social a{
    font-size: 24px;
    color:rgb(211, 211, 214);
    margin-right: 1rem;
}
.social a:hover{
    color: rgba(158, 4, 4, 0.842);
}
.footer-box h3{
    font-size: 1.3rem;
    font-weight: 500;
    margin-bottom: 1rem;
}
.footer-box a,
.footer-box p{
    color: rgb(4, 146, 80);
    margin-bottom: 10px;
}
.footer-box a:hover{
    color: rgb(248, 245, 245);
}
.copyright{
   padding: 5px;
   text-align: center;
   color: rgb(179, 178, 178);
   background: rgb(39, 38, 38);
}

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }
   </style>

    <title>Equipment Booking</title>
</head>

<body>
    <header>
        <div class="nav container">

            <i class='bx bx-menu' id="menu-icon"></i>

            <a href="#" class="logo">Urban<span>crew</span></a>

             <form class="container">
        <h2 style="text-align: center;">Equipment Booking Form</h2>
       <div class="personal-info">
    <!-- Personal Information Section -->
    <h3>Personal Information</h3>
    <div>
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" name="full-name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required></input>
    </div>
</div><br>

        <div class="booked-details">
            <?php

            $booked_item_id = isset($_GET['id']) ? $_GET['id'] : null;

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

// Retrieve booked item details
$sql = "SELECT * FROM equipment WHERE id = ?"; // Assuming 'id' is the primary key of the equipment table
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booked_item_id); // Assuming $booked_item_id contains the ID of the booked item
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of the booked item
    while ($row = $result->fetch_assoc()) {
        echo "Equipment Type: " . $row["equipment_type"] . "<br>";
        echo "Make: " . $row["make"] . "<br>";
        echo "Model: " . $row["model"] . "<br>";
        echo "Year of Manufacture: " . $row["year_of_manufacture"] . "<br>";
        echo "Engine Size: " . $row["engine_size"] . "<br>";
        echo "Horsepower: " . $row["horsepower"] . "<br>";
        echo "Price: " . $row["price"] . "<br>";
        echo "Current Status: " . $row["current_status"] . "<br>";
        // Display image if available
        if (!empty($row["image"])) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" />';
        }
    }
} else {
    echo "No booked item found.";
}

// Close connection
$conn->close();
?>

        </div><br>
        <div class="appointment-section">
            <!-- Appointment Section -->
            <div id="calendar"></div>
            <div>
            <label for="pickup-time">Time of Pick-up:</label>
            <input type="time" id="pickup-time" name="pickup-time">
        </div>
        <div>
            <label for="check-in-date">Check-in Date:</label>
            <input type="text" id="check-in-date" name="check-in-date">
        </div>
        <div>
            <label for="check-out-date">Check-out Date:</label>
            <input type="text" id="check-out-date" name="check-out-date">
        </div>
        </div>
      
       <button type="submit" id="payment-button">Make Payment</button>
    </div>
</div>
</form>
<br>
    
    <section class="footer" id="footer">
        <div class="footer-container ">
            <div class="footer-box">
                <a href="#" class="logo">Urban<span>Crew</span></a>
                <div class="social">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                </div>
                <div class="footer-box">
                    <h3>Page</h3>
                    <a href="#">Home</a>
                    <a href="#">Catalogue</a>
                    <a href="register.php">Sign up</a>
                </div>
            </div>
            <div class="footer-box">
                <h3>Legal</h3>
                <a href="#">Privacy</a>
                <a href="#">Refund Policy</a>
                <a href="#">Cookie Policy</a>
            </div>
            <div class="footer-box">
                <h3>Contacts</h3>
                <p>Kenya</p>
                <p>Uganda</p>
                <p>Tanzania</p>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>@2023 UrbanCrew All RIGHTS RESERVED</p>
    </div>


</body>

<script src="payment.js"></script>
<script src="js/main.js"></script>
<!-- JavaScript for Calendar -->
  <script>
    $(function() {
        $("#check-in-date").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0, // Disable past dates
            onSelect: function(selectedDate) {
                // Set the minimum selectable date for check-out to the selected check-in date
                $("#check-out-date").datepicker("option", "minDate", selectedDate);
            }
        });

        $("#check-out-date").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0, // Disable past dates
            onSelect: function(selectedDate) {
                // Set the maximum selectable date for check-in to the selected check-out date
                $("#check-in-date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>
   
</html>