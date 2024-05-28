<?php
  require_once('config/db.php');
  if (isset($_POST['submit_with_constraints'])) {
    $location = $_POST['location'];
    $price_range = $_POST['price_range'];
    $type = $_POST['type'];
    list($min, $max) = explode("-", $price_range);
    $query = "select * from hotel where location= '$location' and type= '$type' and price between '$min' and '$max' and status= 'available'";
  }

  elseif (isset($_GET['flag']) && $_GET['flag'] == 0) {
    $query = "select * from hotel where status= 'available' order by location asc";
  }
  
  else {
    echo "Invalid request.";
    exit();
  }
  $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <title>Availability</title>
  </head>
  <body class="">
    <div class="container">
      <div class="row mt-5">
        <div class="col">
          <div class="card mt-5">
            <div class="card-header">
              <h2 class="display-6 text-center">Available Rooms...</h2>
            </div>
            <div class="card-body">
              <table class="table table-bordered text-center">
                <tr class="bg-black text-white">
                  <td>Location</td>
                  <td>Description</td>
                  <td>Type</td>
                  <td>Status</td>
                  <td>Price</td>
                  <td>Proceed</td>
                </tr>
                <?php

                  while ($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                  <td><?php echo $row['Location']; ?></td>
                  <td><?php echo $row['H_name']; ?></td>
                  <td><?php echo $row['Description']; ?></td>
                  <td><?php echo $row['Type']; ?></td>
                  <td><?php echo $row['Price']; ?></td>
                  <td><?php echo $row['Status']; ?></td>
                  <td><a href="book.php?id=<?php echo $row['id']; ?>&price=<?php echo $row['Price']; ?>&H_name=<?php echo $row['H_name']; ?>" class="btn btn-primary">Book</a></td>
                </tr>

                <?php
                  }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
