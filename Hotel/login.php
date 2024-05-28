<?php
	session_start(); // Start the session
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Database connection
	$conn = new mysqli('localhost','root','','hotel');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$sql = "SELECT * FROM user where email = '$email' ";
        $result = $conn->query($sql);
        // Check if there are rows returned
        if ($result->num_rows === 1) {
            // Fetch data from each row
            $row = $result->fetch_assoc();
			$userid = $row['UserID'];
			$username = $row['username'];

            if ($password === $row['password']){
                // Process the data as needed
				$_SESSION['userid'] = $userid;
				$_SESSION['username'] = $username;
				include 'service.html';
				echo $userid;
            }
            else{
                echo "password not matching ...";
                include 'login.html';
            }
        } else {
            include 'login.html';
        }

		$conn->close();
		    
	}
?> 