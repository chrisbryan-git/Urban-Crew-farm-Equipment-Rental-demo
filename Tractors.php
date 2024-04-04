<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css\style2.css">
  <style>
    /* CSS for popup */
    .popup {
        display: none;
        position: fixed;
        z-index: 9999; /* Ensure it's above other elements */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    }

    .popup-content {
        background-color: #fefefe;
        margin: 10% auto; /* Center the popup vertically and horizontally */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px; /* Set maximum width */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
  
  <title>Tractors</title>

</head>
<body>
  <header>
 <div class="nav container"> 

   <i class='bx bx-menu' id="menu-icon"></i>

   <a href="#" class="logo">Urban<span>Crew</span></a>

   <ul class="navbar">
      <li><a href="index.html" class="active">Home</a></li>
      <li class="dropdown"><a href="#catalogue">Catalogue</a>
        <ul class="dropdown-menu">
          <li><a href="Tractors.html" class="nav-dropdown " style="color: rgb(7, 7, 7);">Tractor</a></li>
          <li><a href="Harvesters.html" class="nav-dropdown" style="color: rgb(7, 7, 7);">Harvesters</a></li>
          <li><a href="Transporters.html" class="nav-dropdown" style="color: rgb(14, 13, 13);">Transporters</a></li>
          <li><a href="Loaders.html" class="nav-dropdown" style="color: rgb(7, 7, 7);">Loaders</a></li>
          <li><a href="Headers.html" class="nav-dropdown" style="color: rgb(8, 8, 8);">Headers</a></li>
          <li><a href="Sprayers.html" class="nav-dropdown" style="color: rgb(2, 2, 2);">Sprayers</a></li>
          <li><a href="cultivators.html" class="nav-dropdown" style="color: rgb(12, 12, 12);">cultivators</a></li>
          <li><a href="planters.html" class="nav-dropdown" style="color: rgb(10, 10, 10);">planter</a></li>
        </ul>
      </li>
      <li><a href="#about">About us</a></li>
      <li><a href="#footer">contact</a></li>
      <li><a href="register.php">sign up</a></li>
    </ul>

    
      <i class='bx bx-search' id="search-icon"></i>
  
    <div class="search-box container">
       <input type="search" name="" id="" placeholder="search here..." style="color: rgb(251, 252, 253);">
    </div>
 </div>
</header>

<section class="home" id="home">
  <div class="home">
    <div class="bg-img">
       <h1>We have everything from<br> utility to heavy operation <span>equipments</span><br>for all your farming needs.</h1>
   </div>
</div>
</section>

<section class="tractors" id="tractors">
 <div class="heading">
  <span>TRACTORS</span>
 </div>

 <div class="equipment-container container">

  <!-- Display fetched data -->
 <?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "urbancrew_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);
?>

<!-- Display fetched data -->
<?php while ($row = $result->fetch_assoc()): ?>
      <div class="box">
        <?php if ($row['image']): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="">
        <?php else: ?>
            <img src="placeholder_image.jpg" alt="No Image Available">
        <?php endif; ?>
        <h3><?php echo $row['make']; ?></h3>
        <span>Ksh <?php echo $row['price']; ?> per day</span>
        <span>Status: <?php echo $row['current_status']; ?></span>
        <!-- Change the class name to "view-details-link" for clarity -->
        <a href="#" class="btn view-details-link"
           data-make="<?php echo $row['make']; ?>"
           data-model="<?php echo $row['model']; ?>"
           data-year="<?php echo $row['year_of_manufacture']; ?>"
           data-engine="<?php echo $row['engine_size']; ?>"
           data-horsepower="<?php echo $row['horsepower']; ?>"
           data-price="<?php echo $row['price']; ?>"
           data-status="<?php echo $row['current_status']; ?>">View</a>

           <button onclick="window.location.href='book.php?id=<?php echo $row['id']; ?>'" class="btn1">Book Now</button>
    </div>
<?php endwhile; ?>

<!-- Popup for displaying details -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Equipment Details</h2>
        <p id="popup-details"></p>
    </div>
</div>

<script>
    // Get the popup and close button
    var popup = document.getElementById("popup");
    var closeBtn = document.getElementsByClassName("close")[0];

    // Add event listener to close the popup when the close button is clicked
    closeBtn.addEventListener("click", function() {
        popup.style.display = "none";
    });

    // Get all elements with class "view-details-link" (the links)
    var viewDetailsLinks = document.querySelectorAll(".view-details-link");

    // Loop through each link and add an event listener
    viewDetailsLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default link behavior
            
            // Get the details from the data attributes
            var make = link.getAttribute("data-make");
            var model = link.getAttribute("data-model");
            var year = link.getAttribute("data-year");
            var engine = link.getAttribute("data-engine");
            var horsepower = link.getAttribute("data-horsepower");
            var price = link.getAttribute("data-price");
            var status = link.getAttribute("data-status");

            // Set the popup content with the details
            document.getElementById("popup-details").innerHTML = "Make: " + make + "<br>" +
                                                                 "Model: " + model + "<br>" +
                                                                 "Year of Manufacture: " + year + "<br>" +
                                                                 "Engine Size: " + engine + " Liters<br>" +
                                                                 "Horsepower: " + horsepower + "<br>" +
                                                                 "Price: Ksh " + price + " per day<br>" +
                                                                 "Status: " + status;

            // Show the popup
            popup.style.display = "block";
        });
    });
</script>

<?php $conn->close(); ?>


  </div>

<section class="about container" id="about">
  <div class="about-img">
    <img src="https://www.rbauction.com/cms_assets/category_images/12889512079/12889512079_W_S.jpg" alt="">
  </div>

<div class="about-text">
  <span>About us</span>
  <h2>Quality equipments at <br>cheap affordable prices</h2>
  <p>We as an agricultural rental center, pride in ensuring that our customer get the best quality equipments we can
    offer.<br>
    Our aim is to encourage the use of farm machinery to promote agricultural development in the country.
  </p>
  </div>
</section>
<section class="footer" id="footer">
   <div class="footer-container container">
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
    



<script src="js/search.js"></script>
</body>
</html>