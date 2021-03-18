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

    //get the path of the file to open
    $file = $_POST['open'];
    $path = ".files/$usr/$file";

    //get the type and the mime of the file
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $mime = $file_info->file($path);
    header("Content-Type: ".$mime);

    ob_clean();
    flush();

    //open the file in a new tab
    readfile($path);
    exit;
?>