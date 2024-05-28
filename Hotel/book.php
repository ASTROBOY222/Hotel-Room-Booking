<?php
  session_start();
  if (!isset($_GET['id'], $_GET['price'], $_GET['H_name'])) {
    echo "Session data is missing.";
    exit();
  }
  $id = $_GET['id'];
  $price = $_GET['price'];
  $h_name = $_GET['H_name'];
  
  $_SESSION['roomid'] = $id;
  $_SESSION['price'] = $price;
  $_SESSION['h_name'] = $h_name;
  echo $id, $price;

  $today = date("Y-m-d");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Booking System</title>
    <link rel="stylesheet" href="css/book.css" />
    <script defer src="book.js"></script>
  </head>
  <body>
    <header>
      <h1>Welcome to Our Hotel Booking System</h1>
    </header>
    <main>
      <section class="booking-form">
        <h2>Book Your Stay</h2>
        <form id="bookingForm" action="payment.php" method="post">
          <label for="checkin">Check-In Date:</label>
          <input type="date" id="checkin" name="checkin" value="<?php echo $today; ?>" />

          <label for="checkout">Check-Out Date:</label>
          <input type="date" id="checkout" name="checkout" required />

          <button type="submit">Book Now</button>
        </form>
      </section>
    </main>
    <footer>
      <p>&copy; 2024 Hotel Booking System. All rights reserved.</p>
    </footer>
  </body>
</html>

