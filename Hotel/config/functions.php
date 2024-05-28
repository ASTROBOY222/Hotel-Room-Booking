<?php
    require_once('db.php');
    
	$email = $_POST['email'];
	$password = $_POST['password'];

	function user_check(){
		$sql = "SELECT * FROM user where email = '$email' ";
        $result = $conn->query($sql);
        // Check if there are rows returned
        if ($result->num_rows === 1) {
            // Fetch data from each row
            $row = $result->fetch_assoc();
	    	$userid = $row['UserID'];

            if ($password === $row['password']){
                // Process the data as needed
				return true;
            }
            else{
                echo "password not matching ...";
                //include 'login.html';
				return false;
            }
        } else {
            // include 'login.html';
			return false;
        }

	    $conn->close();
	}
?>