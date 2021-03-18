<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Sharing</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1 class="welcome">Welcome to the File Sharing App</h1>

    <div id="content">
        <div class="connexion">
            <h3>Log In to Manage Your Files</h3>
            <form action="login.php" method="POST">
                <input type="text" name="l_usr" maxlength="20"  placeholder="Type Username" />
                <br><br>
                <input type="password" name="l_pwd" maxlength="20" placeholder="Type Password" />

                <?php
                    //Display a message error if any
                    if (isset($_SESSION['l_error'])) {
                        $error_msg = $_SESSION['l_error'];
                        echo "<p class='error'>$error_msg</p>";
                    } else {
                        echo "<br><br>";
                    }
                ?>

                <input type="submit" value="Log in"/>
            </form>
        </div>

        <div class="connexion">
            <h3>Sign Up to the File Sharing App</h3>
            <form action="signup.php" method="POST">
                <input type="text" name="s_usr" maxlength="20" placeholder="Type Username" />
                <br><br>
                <input type="password" name="s_pwd1" maxlength="20" placeholder="Type Password" />
                <br><br>
                <input type="password" name="s_pwd2" maxlength="20" placeholder="Retype Password" />

                <?php
                    //diplay a message error if any
                    if (isset($_SESSION['s_error'])) {
                        $error_msg = $_SESSION['s_error'];
                        echo "<p class='error'>$error_msg</p>";
                    } else {
                        echo "<br><br>";
                    }

                    session_destroy();
                ?>
                
                <input type="submit" value="Sign up"/>
            </form>
        </div>
    </div>
</body>
</html>
