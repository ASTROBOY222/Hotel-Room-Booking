<?php
	session_start();
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];

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
			echo "already existing email... ";
			include "register.html";
        } else {
			$stmt = $conn->prepare("insert into user(username, email, password, phone) values(?, ?, ?, ?)");
		    $stmt->bind_param("sssi", $username, $email, $password, $phone);
			$execval = $stmt->execute();
			$stmt->close();

			$sql = "SELECT * FROM user where email = '$email' ";
        	$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$userid = $row['UserID'];
			$username = $row['username'];

			$_SESSION['userid'] = $userid;
			$_SESSION['username'] = $username;
			include 'service.html';
        }

		$conn->close();
	}
?>