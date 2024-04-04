<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Booking</title>
</head>

<body>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id_no = $_POST['id_no'];
    $phone = $_POST['phone'];
    $check_out_date = $_POST['check_out_date'];
    $check_in_date = $_POST['check_in_date'];

    // Combine form data with equipment booking info
    // Assuming $equipment_id, $image, $title, and $time are already defined

    // Display confirmation form
    echo '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Confirmation</title>
    </head>
    
    <body>';
    
    // Display booking info
    echo '<div class="booking-info">
    <div class="booking-item">
        <img src="' . $image . '" alt="Equipment Image">
        <div class="booking-details">
            <div class="booking-title">Title: ' . $title . '</div>
            <div class="booking-id">ID: ' . $equipment_id . '</div>
            <div class="booking-time">Time: ' . $time . '</div>
        </div>
    </div>
</div>';

    // Display form data for confirmation
    echo '<div class="confirmation-form">
    <h2>Confirm Booking Details</h2>
    <p>Name: ' . $name . '</p>
    <p>Email: ' . $email . '</p>
    <p>ID Number: ' . $id_no . '</p>
    <p>Phone Number: ' . $phone . '</p>
    <p>Check-out Date: ' . $check_out_date . '</p>
    <p>Check-in Date: ' . $check_in_date . '</p>
    <form action="final_booking.php" method="post">
        <!-- Hidden fields to pass form data -->
        <input type="hidden" name="name" value="' . $name . '">
        <input type="hidden" name="email" value="' . $email . '">
        <input type="hidden" name="id_no" value="' . $id_no . '">
        <input type="hidden" name="phone" value="' . $phone . '">
        <input type="hidden" name="check_out_date" value="' . $check_out_date . '">
        <input type="hidden" name="check_in_date" value="' . $check_in_date . '">
        <button type="submit">Confirm Booking</button>
    </form>
</div>';
    
    echo '</body></html>';
} else {
    echo "Form data not submitted.";
}
?>

</body>

</html>
