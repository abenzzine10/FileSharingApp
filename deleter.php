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

    //getting path of the file to delete
    $file = $_POST['delete'];
    $path = ".files/$usr/$file";

    //delete file
    unlink($path);

    //refresh
    header("Location: main.php");
    exit;
?>