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
    
    //Get path of file to download
    $file = $_POST['download'];
    $path = ".files/$usr/$file";

    //Get the type and mime of the file
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $mime = $file_info->file($path);
    header("Content-Type: ".$mime);

    //headers from "https://www.php.net/manual/en/function.readfile.php"
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($path));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));

    ob_clean();
    flush();

    //Download the file
    readfile($path);
    exit;
?>