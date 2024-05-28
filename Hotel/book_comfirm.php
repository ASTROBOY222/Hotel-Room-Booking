<?php
    session_start();
    if (!isset($_SESSION['roomid'], $_SESSION['userid'], $_SESSION['checkin'], $_SESSION['checkout'], $_SESSION['h_name'], $_SESSION['username'])) {
        echo "Session data is missing.";
        exit();
    }
    $roomID = $_SESSION['roomid'];
    $userID = $_SESSION['userid'];
    $checkIn = $_SESSION['checkin'];
    $checkOut = $_SESSION['checkout'];
    $h_name = $_SESSION['h_name'];
    $username = $_SESSION['username'];


    require_once('config/db.php');
    
    $sql = "INSERT INTO booking (RoomID, UserID, CheckIn, CheckOut) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }
    $stmt->bind_param("iiss", $roomID, $userID, $checkIn, $checkOut);
    $result = $stmt->execute();
    $bookingID = $stmt->insert_id;
    if ($result === false) {
        echo "Error: " . $stmt->error;
    } else {
        echo "Booking inserted successfully.";
    }
    $stmt->close();

    $checkoutDateTime = date("Y-m-d 00:00:00", strtotime($checkOut));
    $sql0 = "CREATE EVENT make_room_available_$roomID
            ON SCHEDULE AT '$checkoutDateTime'
            DO
            BEGIN
                UPDATE hotel
                SET Status = 'available'
                WHERE id = $roomID;
            END";
    
    if ($conn->query($sql0) === TRUE) {
        echo "Event scheduled successfully.";
    } else {
        echo "Error scheduling event: " . $conn->error;
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/book_confirm1.css" />
  </head>
  <body>
    <header>
      <h1>Hotel Booking Confirmation</h1>
    </header>
    <div class="booking-form">
      <h2>Booking Details</h2>
      <form>
        <div class="form-group">
          <label for="confirmationNumber">Booking Confirmation Number:</label>
          <h3><?php echo $bookingID; ?></h3>
        </div>
        <div class="form-group">
          <label for="bookingDate">Date of Booking:</label>
          <h3><?php echo $checkIn ?></h3>
        </div>
        <div class="form-group">
          <label for="guestName">Guest Name:</label>
          <h3><?php echo $username; ?></h3>
        </div>
        <div class="form-group">
          <label for="hotelName">Hotel Name:</label>
          <h3><?php echo $h_name; ?></h3>
        </div>
        <div class="form-group">
          <label for="checkinDate">Check-in Date:</label>
          <h3><?php echo $checkIn; ?></h3>
        </div>
        <div class="form-group">
          <label for="checkoutDate">Check-out Date:</label>
          <h3><?php echo $checkOut; ?></h3>
        </div>
        <h2>Booking Successful!!!</h2>
      </form>
    </div>
  </body>
</html>
