<?php
  session_start();
  if (isset($_SESSION['price'])) {
    $price = $_SESSION['price'];
  } else {
    echo "No user ID found.";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $checkinDate = new DateTime($checkin);
    $checkoutDate = new DateTime($checkout);

    $interval = $checkinDate->diff($checkoutDate);

    $nights = $interval->days;

    if ($checkoutDate <= $checkinDate) {
        echo "Check-out date must be after the check-in date.";
    }
  } else {
    echo "Please submit the form.";
  }
  $_SESSION['checkin'] = $checkin;
  $_SESSION['checkout'] = $checkout;
  $amount = $nights*$price;
  $_SESSION['amount'] = $amount;
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Room Payment</title>
    <link rel="stylesheet" href="css/paym.css" />
  </head>
  <body>
    <div class="container">
      <h1>Hotel Payment</h1>
      <form id="paymentForm" action="book_comfirm.php" method="post">
        <h1>&#8377;<?php echo $amount;?></h1>

        <h2><label for="paymentMethod">Payment Method:</label></h2>
        <select id="paymentMethod" name="paymentMethod" required>
          <option value="">Select Payment Method</option>
          <option value="UPI">UPI</option>
          <option value="Credit Card">Credit Card</option>
          <option value="Debit Card">Debit Card</option>
          <option value="Net Banking">Net Banking</option>
        </select>

        <a href="book_comfirm.php"><button type="submit">Pay</button></a>
        <button type="submit">Decline</button>
      </form>
      <div id="result"></div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
