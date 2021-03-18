<?php
	session_start();

	//User has to log in to access this page. Otherwise, they get redirected to the log in page
	if(isset($_SESSION['usr'])){
		$usr = $_SESSION['usr'];
	} else {
		$_SESSION['l_error'] = "Log In";
		header("Location: index.php");
		exit;
	}

	//make sure the file name doesn't contain any special characters
	$file = basename($_FILES['upload']['name']);
	if( !preg_match('/^[\w_\.\-]+$/', $file) ){
        echo '<p>Invalid name of file</p><form action="main.php" method="POST"><input type="submit" value="Back to the Main Menu"</input></form>';
        exit;
    }

	//upload the file to the appropriate directory
	$path = ".files/$usr/$file";
	if(!move_uploaded_file($_FILES['upload']['tmp_name'], $path) ){
		$_SESSION['error'] = "Error while uploading";	
	}

	//refresh the page
	header("Location: main.php");
	exit;
?>