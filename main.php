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

	//create directory for user if they don't have one already
	if (!file_exists(".files/$usr")){
		mkdir(".files/$usr");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Main Menu</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1 class="welcome">Welcome to the File Sharing App</h1>

	<div id="upload">
		<form enctype="multipart/form-data" action="uploader.php" method="POST">
			<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
			<label for="file">Upload a file </label>
			<input name="upload" type="file" id="file" />
			<input type="submit" value="Upload" />
		</form>
	</div>

	<?php
		//get all the files for this user
		$folder = ".files/$usr";
		$files = scandir($folder);
		
		//Display the files with the open button
		echo '<div id="categories"><div class="category"><form target="_blank" action="opener.php" method="POST"><p>Open a file</p>';
		for($i = 2; $i < count($files); $i++){
			echo '<input type="radio" name="open" value="'.$files[$i].'" id="'.$files[$i].'" />';
			echo '<label for="'.$files[$i].'">'.$files[$i].'</label><br><br>';
		}
		echo '<input type="submit" value="Open" /></form></div>';

		//display the files with the download button
		echo '<div class="category"><form action="downloader.php" method="POST"><p>Download a file</p>';
		for($i = 2; $i < count($files); $i++){
			echo '<input type="radio" name="download" value="'.$files[$i].'" id="'.$files[$i].'" />';
			echo '<label for="'.$files[$i].'">'.$files[$i].'</label><br><br>';
		}
		echo '<input type="submit" value="Download" /></form></div>';

		//display the files with the delete button
		echo '<div class="category"><form action="deleter.php" method="POST"><p>Delete a file</p>';
		for($i = 2; $i < count($files); $i++){
			echo '<input type="radio" name="delete" value="'.$files[$i].'" id="'.$files[$i].'" />';
			echo '<label for="'.$files[$i].'">'.$files[$i].'</label><br><br>';
		}
		echo '<input type="submit" value="Delete"/></form></div></div><br><br>';
	?>

	<form action="index.php" method="POST"><input type="submit" value="Log out"/></form>
</body>
</html>